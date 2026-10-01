<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Models\StudentsModel;
use App\Models\EmployeesModel;
use App\Models\ClassesModel;
use App\Models\FeesGenerationModel;
use App\Models\StudentAttendanceModel;

/**
 * Read-only queries backing the admin dashboard (app/Views/pages/admin-module-pages/dashboard.php).
 * The dashboard used to render entirely hardcoded/demo numbers; this
 * replaces them with real counts from the database.
 */
class DashboardStatsController extends BaseController
{
    protected $db;
    protected $studentsModel;
    protected $employeesModel;
    protected $classesModel;
    protected $feesGenerationModel;
    protected $studentAttendanceModel;

    public function __construct()
    {
        $this->db                     = \Config\Database::connect();
        $this->studentsModel          = new StudentsModel();
        $this->employeesModel         = new EmployeesModel();
        $this->classesModel           = new ClassesModel();
        $this->feesGenerationModel    = new FeesGenerationModel();
        $this->studentAttendanceModel = new StudentAttendanceModel();
    }

    public function getStats(): array
    {
        return [
            'totalStudents'    => $this->studentsModel->countAllResults(),
            'totalTeachers'    => $this->countTeachers(),
            'totalClasses'     => $this->classesModel->countAllResults(),
            'totalDues'        => $this->totalOutstandingDues(),
            'recentAdmissions' => $this->recentAdmissions(5),
            'pendingDues'      => $this->pendingDues(5),
            'feesChart'        => $this->feesChartLastSixMonths(),
            'attendanceToday'  => $this->attendanceToday(),
        ];
    }

    private function countTeachers(): int
    {
        return (int) $this->db->table('employees')
            ->join('roles', 'roles.id = employees.role_id')
            ->where('roles.role_name', 'Teacher')
            ->where('employees.deleted_at', null)
            ->where('roles.deleted_at', null)
            ->countAllResults();
    }

    /**
     * Outstanding = generated - discounts - allocated payments, across all
     * non-deleted fees_generation rows. Mirrors the per-student ledger
     * calculation in FeesManagementController::getStudentFeesLedger(), just
     * aggregated instead of per-row.
     */
    private function totalOutstandingDues(): float
    {
        $generated = (float) ($this->db->table('fees_generation')
            ->selectSum('amount')
            ->where('deleted_at', null)
            ->get()->getRow('amount') ?? 0);

        $discounted = (float) ($this->db->table('fees_discount')
            ->selectSum('discount_amount')
            ->where('deleted_at', null)
            ->get()->getRow('discount_amount') ?? 0);

        $allocated = (float) ($this->db->table('fees_allocation')
            ->selectSum('amount')
            ->where('deleted_at', null)
            ->get()->getRow('amount') ?? 0);

        return max(0, $generated - $discounted - $allocated);
    }

    private function recentAdmissions(int $limit): array
    {
        return $this->db->table('students')
            ->select('students.id, students.firstname, students.lastname, students.admission_date, students.created_at, classes.label AS class_label, sections.section_label')
            ->join('classes', 'classes.id = students.related_class', 'left')
            ->join('sections', 'sections.id = students.related_section', 'left')
            ->where('students.deleted_at', null)
            ->orderBy('students.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Fees_generation rows with a positive outstanding balance, soonest
     * due_date first — same "generated - discount - allocated" math as
     * totalOutstandingDues(), computed per row via subqueries so it stays
     * a single query.
     */
    private function pendingDues(int $limit): array
    {
        $builder = $this->db->table('fees_generation fg');
        $builder->select("
                fg.id,
                fg.month,
                fg.year,
                fg.due_date,
                CAST(fg.amount AS DECIMAL(10,2)) AS generated_amount,
                students.firstname,
                students.lastname,
                (
                    CAST(fg.amount AS DECIMAL(10,2))
                    - COALESCE((SELECT SUM(discount_amount) FROM fees_discount fd WHERE fd.generated_fee = fg.id AND fd.deleted_at IS NULL), 0)
                    - COALESCE((SELECT SUM(amount) FROM fees_allocation fa WHERE fa.related_generated_fee = fg.id AND fa.deleted_at IS NULL), 0)
                ) AS outstanding
            ", false)
            ->join('students', 'students.id = fg.student_id', 'left')
            ->where('fg.deleted_at', null);

        // Filter on the computed column via a wrapping query, since MySQL
        // can't reference a SELECT alias in the same query's WHERE clause.
        $sql = "SELECT * FROM ({$builder->getCompiledSelect()}) AS ledger
                WHERE outstanding > 0
                ORDER BY due_date ASC
                LIMIT {$limit}";

        return $this->db->query($sql)->getResultArray();
    }

    private function feesChartLastSixMonths(): array
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = date('Y-m', strtotime("-{$i} months"));
        }

        $generatedByMonth = $this->db->table('fees_generation')
            ->select("DATE_FORMAT(due_date, '%Y-%m') AS ym, SUM(CAST(amount AS DECIMAL(10,2))) AS total", false)
            ->where('deleted_at', null)
            ->where('due_date >=', date('Y-m-01', strtotime('-5 months')))
            ->groupBy('ym')
            ->get()->getResultArray();

        $collectedByMonth = $this->db->table('fees_payments')
            ->select("DATE_FORMAT(payment_date_time, '%Y-%m') AS ym, SUM(paid_amount) AS total", false)
            ->where('deleted_at', null)
            ->where('payment_date_time >=', date('Y-m-01', strtotime('-5 months')))
            ->groupBy('ym')
            ->get()->getResultArray();

        $generatedMap  = array_column($generatedByMonth, 'total', 'ym');
        $collectedMap  = array_column($collectedByMonth, 'total', 'ym');

        $categories = [];
        $generated  = [];
        $collected  = [];

        foreach ($months as $ym) {
            $categories[] = date('M', strtotime($ym . '-01'));
            $generated[]  = round((float) ($generatedMap[$ym] ?? 0), 2);
            $collected[]  = round((float) ($collectedMap[$ym] ?? 0), 2);
        }

        return [
            'categories' => $categories,
            'generated'  => $generated,
            'collected'  => $collected,
        ];
    }

    private function attendanceToday(): array
    {
        $today = date('Y-m-d');

        $present = (int) $this->studentAttendanceModel
            ->where('date', $today)
            ->where('status', 'present')
            ->countAllResults();

        $absent = (int) $this->studentAttendanceModel
            ->where('date', $today)
            ->where('status', 'absent')
            ->countAllResults();

        $totalStudents = $this->studentsModel->countAllResults();
        $marked        = $present + $absent;
        $notMarked     = max(0, $totalStudents - $marked);

        return [
            'present'    => $present,
            'absent'     => $absent,
            'notMarked'  => $notMarked,
            'totalToday' => $marked,
        ];
    }
}
