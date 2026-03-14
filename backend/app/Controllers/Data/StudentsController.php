<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Libraries\JwtHandler;

class StudentsController extends BaseController
{

    protected $studentsModel;
    protected $db;
    protected $request;

    public function __construct()
    {
        $this->studentsModel = model('StudentsModel');
        $this->request       = service('request');
        $this->db            = \Config\Database::connect();
    }

    // ─────────────────────────────────────────────
    //  AUTH
    // ─────────────────────────────────────────────

    public function studentLogin($studentDetailsFromRequest)
    {
        $studentEmail    = $studentDetailsFromRequest['email'];
        $studentPassword = $studentDetailsFromRequest['password'];

        $studentDetails = $this->studentsModel
            ->groupStart()
                ->where('student_email', $studentEmail)
                ->orWhere('student_contact_no', $studentEmail)
            ->groupEnd()
            ->where('password', $studentPassword)
            ->first();

        if (!$studentDetails) {
            return json_encode([
                'status'  => 0,
                'message' => 'Account Not Found',
            ]);
        }

        $jwt   = new JwtHandler();
        $token = $jwt->generateToken([
            'id'        => $studentDetails['id'],
            'loginType' => 'student',
        ]);

        $this->studentsModel->update(
            $studentDetails['id'],
            ['issued_jwt_token' => $token]
        );

        return json_encode([
            'status' => 1,
            'token'  => $token,
        ]);
    }

    // ─────────────────────────────────────────────
    //  PROFILE
    // ─────────────────────────────────────────────

    public function getStudentById($studentId)
    {
        $builder = $this->studentsModel->builder();

        $builder->select('
            students.*,
            classes.class_name,
            sections.section_label
        ');

        $builder->join('classes', 'classes.id = students.related_class', 'left');
        $builder->join('sections', 'sections.id = students.related_section', 'left');

        $builder->where('students.id', $studentId);
        $builder->where('students.deleted_at', null);

        return $builder->get()->getRowArray();
    }

    // ─────────────────────────────────────────────
    //  PAGINATION HELPER
    // ─────────────────────────────────────────────

    private function paginate($builder, $perPage, $pageParam)
    {
        $page   = (int) ($this->request->getGet($pageParam) ?? 1);
        $page   = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $perPage;

        $total = $builder->countAllResults(false);

        $builder->limit($perPage, $offset);

        return [
            'rows'  => $builder->get()->getResultArray(),
            'total' => $total,
            'pager' => service('pager')->makeLinks($page, $perPage, $total, 'default_full', 0, $pageParam),
        ];
    }

    // ─────────────────────────────────────────────
    //  ATTENDANCE
    // ─────────────────────────────────────────────

    public function getStudentAttendance($studentId, $perPage = 10)
    {
        $builder = $this->db->table('student_attendance');

        $builder->where('student_id', $studentId);
        $builder->where('deleted_at', null);
        $builder->orderBy('date', 'DESC');

        return $this->paginate($builder, $perPage, 'attendance_page');
    }

    /**
     * Summary counts: present / absent / late / total
     */
    public function getStudentAttendanceSummary($studentId)
    {
        $base = $this->db->table('student_attendance')
            ->where('student_id', $studentId)
            ->where('deleted_at', null);

        $total   = (clone $base)->countAllResults(false);
        $present = (clone $base)->where('status', 'present')->countAllResults(false);
        $absent  = (clone $base)->where('status', 'absent')->countAllResults(false);
        $late    = (clone $base)->where('status', 'late')->countAllResults(false);

        return [
            'total'      => $total,
            'present'    => $present,
            'absent'     => $absent,
            'late'       => $late,
            'percentage' => $total > 0 ? round(($present / $total) * 100, 1) : 0,
        ];
    }

    // ─────────────────────────────────────────────
    //  FEES
    // ─────────────────────────────────────────────

    public function getStudentFees($studentId,$perPage=10)
    {
        $builder = $this->db->table('fees_payments');

        $builder->where('student_id',$studentId);
        $builder->where('deleted_at',null);

        $status = $this->request->getGet('fee_status');

        if($status && $status!='all'){
            $builder->where('status',$status);
        }

        $builder->orderBy('created_at','DESC');

        return $this->paginate($builder,$perPage,'fees_page');
    }

    public function getStudentFeeStats($studentId)
    {
        $builder = $this->db->table('fees_payments');

        $builder->select("
            COUNT(*) as total,
            SUM(status='paid') as paid,
            SUM(status='pending') as pending,
            SUM(status='overdue') as overdue
        ");

        $builder->where('student_id',$studentId);
        $builder->where('deleted_at',null);

        return $builder->get()->getRowArray();
    }



    // ─────────────────────────────────────────────
    //  ASSIGNMENTS
    // ─────────────────────────────────────────────

    /**
     * All assignments for the student's class/section,
     * left-joined with that student's submission (if any).
     * Status is computed: submitted | overdue | pending.
     */
    public function getStudentAssignments($studentId, $perPage = 10)
    {
        $student = $this->studentsModel->find($studentId);

        if (!$student) {
            return ['rows' => [], 'total' => 0, 'pager' => ''];
        }

        $safeId = (int) $studentId;

        $builder = $this->db->table('assignments a');

        $builder->select("
            a.id,
            a.topic,
            a.deadline_date,
            a.deadline_time,
            a.created_at AS assigned_date,
            sub.subject_name,
            s.id          AS submission_id,
            s.marks,
            s.grade,
            s.created_at  AS submitted_at,
            CASE
                WHEN s.id IS NOT NULL                        THEN 'submitted'
                WHEN a.deadline_date < CURDATE()             THEN 'overdue'
                WHEN a.deadline_date = CURDATE()
                     AND a.deadline_time < CURTIME()         THEN 'overdue'
                ELSE 'pending'
            END AS status
        ");

        $builder->join('subjects sub', 'sub.id = a.related_subject', 'left');

        // Left-join only this student's submission row
        $builder->join(
            "assignment_submissions s",
            "s.related_assignment = a.id
             AND s.related_student = {$safeId}
             AND s.deleted_at IS NULL",
            'left'
        );

        $builder->where('a.related_class', $student['related_class']);
        $builder->where('a.related_section', $student['related_section']);
        $builder->where('a.deleted_at', null);
        $builder->orderBy('a.deadline_date', 'DESC');

        // Apply subject filter if passed via GET
        $subjectFilter = $this->request->getGet('assignment_subject');
        if ($subjectFilter && $subjectFilter !== 'all') {
            $builder->where('a.related_subject', (int) $subjectFilter);
        }

        return $this->paginate($builder, $perPage, 'assignment_page');
    }

    /**
     * Summary stats for the assignments tab header cards.
     */
    public function getStudentAssignmentStats($studentId)
    {
        $student = $this->studentsModel->find($studentId);

        if (!$student) {
            return ['total' => 0, 'submitted' => 0, 'pending' => 0, 'overdue' => 0];
        }

        $safeId = (int) $studentId;

        // Total assignments for this class/section
        $total = $this->db->table('assignments')
            ->where('related_class', $student['related_class'])
            ->where('related_section', $student['related_section'])
            ->where('deleted_at', null)
            ->countAllResults();

        // Submitted by this student
        $submitted = $this->db->table('assignment_submissions')
            ->where('related_student', $safeId)
            ->where('deleted_at', null)
            ->countAllResults();

        // Overdue: deadline passed, no submission
        $overdueBuilder = $this->db->table('assignments a');
        $overdueBuilder->join(
            "assignment_submissions s",
            "s.related_assignment = a.id
             AND s.related_student = {$safeId}
             AND s.deleted_at IS NULL",
            'left'
        );
        $overdueBuilder->where('a.related_class', $student['related_class']);
        $overdueBuilder->where('a.related_section', $student['related_section']);
        $overdueBuilder->where('a.deleted_at', null);
        $overdueBuilder->where('a.deadline_date <', date('Y-m-d'));
        $overdueBuilder->where('s.id IS NULL', null, false);
        $overdue = $overdueBuilder->countAllResults();

        return [
            'total'     => $total,
            'submitted' => $submitted,
            'overdue'   => $overdue,
            'pending'   => max(0, $total - $submitted - $overdue),
        ];
    }

    /**
     * Distinct subjects that have assignments for this student's class.
     * Used to populate the subject filter dropdown.
     */
    public function getAssignmentSubjects($studentId)
    {
        $student = $this->studentsModel->find($studentId);

        if (!$student) {
            return [];
        }

        return $this->db->table('assignments a')
            ->select('sub.id, sub.subject_name')
            ->join('subjects sub', 'sub.id = a.related_subject', 'left')
            ->where('a.related_class', $student['related_class'])
            ->where('a.related_section', $student['related_section'])
            ->where('a.deleted_at', null)
            ->groupBy('sub.id')
            ->orderBy('sub.subject_name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getAssignmentDetails($assignmentId, $studentId)
    {
        return $this->db->table('assignments a')
            ->select('
                a.*,
                subjects.subject_name,
                s.upload_answers,
                s.marks,
                s.grade,
                s.created_at AS submitted_at
            ')
            ->join('subjects', 'subjects.id = a.related_subject', 'left')
            ->join(
                'assignment_submissions s',
                "s.related_assignment = a.id AND s.related_student = {$studentId}",
                'left'
            )
            ->where('a.id', $assignmentId)
            ->get()
            ->getRowArray();
    }

    // ─────────────────────────────────────────────
    //  MARKS  (flat list – for simple marks page)
    // ─────────────────────────────────────────────

    public function getStudentMarks($studentId, $perPage = 10)
    {
        $builder = $this->db->table('exam_marks m');

        $builder->select('
            m.obtained_marks,
            ei.max_marks,
            ei.exam_date,
            sub.subject_name,
            ex.exam_title
        ');

        $builder->join('exam_items ei', 'ei.id = m.related_exam_item', 'left');
        $builder->join('subjects sub', 'sub.id = ei.related_subject', 'left');
        $builder->join('exams ex', 'ex.id = ei.related_exam', 'left');

        $builder->where('m.related_student', $studentId);
        $builder->where('m.deleted_at', null);

        return $this->paginate($builder, $perPage, 'marks_page');
    }

    // ─────────────────────────────────────────────
    //  MARKSHEETS  (grouped by exam – for marksheet tab)
    // ─────────────────────────────────────────────

    public function getStudentMarksByExam($studentId)
    {
        $rows = $this->db->table('exam_marks m')
            ->select('
                m.obtained_marks,
                ei.max_marks,
                ei.exam_date,
                ei.related_exam,
                sub.subject_name,
                ex.exam_title,
                ex.exam_startdate,
                ex.exam_enddate
            ')
            ->join('exam_items ei', 'ei.id = m.related_exam_item', 'left')
            ->join('subjects sub', 'sub.id = ei.related_subject', 'left')
            ->join('exams ex', 'ex.id = ei.related_exam', 'left')
            ->where('m.related_student', $studentId)
            ->where('m.deleted_at', null)
            ->orderBy('ex.exam_startdate', 'ASC')
            ->orderBy('sub.subject_name', 'ASC')
            ->get()
            ->getResultArray();

        // Group by exam
        $grouped = [];
        foreach ($rows as $row) {
            $examId = $row['related_exam'];

            if (!isset($grouped[$examId])) {
                $grouped[$examId] = [
                    'exam_title'     => $row['exam_title'] ?? 'Unknown Exam',
                    'exam_startdate' => $row['exam_startdate'],
                    'exam_enddate'   => $row['exam_enddate'],
                    'subjects'       => [],
                    'total_obtained' => 0,
                    'total_max'      => 0,
                ];
            }

            $obtained = (int) $row['obtained_marks'];
            $max      = (int) $row['max_marks'];

            $grouped[$examId]['subjects'][] = [
                'subject_name'  => $row['subject_name'],
                'obtained_marks'=> $obtained,
                'max_marks'     => $max,
                'grade'         => $this->gradeFromPercentage($max > 0 ? ($obtained / $max) * 100 : 0),
                'remarks'       => $this->remarksFromPercentage($max > 0 ? ($obtained / $max) * 100 : 0),
            ];

            $grouped[$examId]['total_obtained'] += $obtained;
            $grouped[$examId]['total_max']      += $max;
        }

        // Add overall percentage per exam
        foreach ($grouped as &$exam) {
            $exam['percentage'] = $exam['total_max'] > 0
                ? round(($exam['total_obtained'] / $exam['total_max']) * 100, 1)
                : 0;
            $exam['division'] = $this->divisionFromPercentage($exam['percentage']);
        }
        unset($exam);

        return $grouped;
    }

    public function getStudentDocumentStats($studentId)
    {
        $builder = $this->db->table('documents');

        $builder->select("
            COUNT(*) as total,
            SUM(status = 'verified') as verified,
            SUM(status = 'pending') as pending,
            SUM(status = 'rejected') as rejected
        ");

        $builder->where('related_student', $studentId);
        $builder->where('deleted_at', null);

        return $builder->get()->getRowArray();
    }

    public function getStudentDocuments($studentId, $perPage = 10, $sort = 'latest')
    {
        $builder = $this->db->table('documents');

        $builder->where('related_student', $studentId);
        $builder->where('deleted_at', null);

        switch ($sort) {

            case 'oldest':
                $builder->orderBy('created_at', 'ASC');
                break;

            case 'verified':
                $builder->where('status', 'verified');
                $builder->orderBy('created_at', 'DESC');
                break;

            case 'pending':
                $builder->where('status', 'pending');
                $builder->orderBy('created_at', 'DESC');
                break;

            default: // latest
                $builder->orderBy('created_at', 'DESC');
        }

        return $this->paginate($builder, $perPage, 'documents_page');
    }

    // ─────────────────────────────────────────────
    //  PRIVATE HELPERS
    // ─────────────────────────────────────────────

    private function gradeFromPercentage(float $pct): string
    {
        if ($pct >= 90) return 'A+';
        if ($pct >= 80) return 'A';
        if ($pct >= 70) return 'B+';
        if ($pct >= 60) return 'B';
        if ($pct >= 50) return 'C';
        if ($pct >= 40) return 'D';
        return 'F';
    }

    private function remarksFromPercentage(float $pct): string
    {
        if ($pct >= 90) return 'Outstanding';
        if ($pct >= 80) return 'Excellent';
        if ($pct >= 70) return 'Very Good';
        if ($pct >= 60) return 'Good';
        if ($pct >= 50) return 'Average';
        if ($pct >= 40) return 'Below Average';
        return 'Fail';
    }

    private function divisionFromPercentage(float $pct): string
    {
        if ($pct >= 60) return 'First Division';
        if ($pct >= 45) return 'Second Division';
        if ($pct >= 33) return 'Third Division';
        return 'Fail';
    }

    public function getStudentSubjects($studentId)
    {
        $student = $this->studentsModel->find($studentId);

        return $this->db->table('subject_allocations sa')
            ->select('subjects.subject_name, employees.firstname, employees.lastname')
            ->join('subjects', 'subjects.id = sa.subject', 'left')
            ->join('employees', 'employees.id = sa.teacher', 'left')
            ->where('sa.class', $student['related_class'])
            ->where('sa.section', $student['related_section'])
            ->where('sa.deleted_at', null)
            ->get()
            ->getResultArray();
    }

    

    public function getStudentSchedule($studentId)
    {
        $student = $this->studentsModel->find($studentId);

        return $this->db->table('schedules sc')
            ->select('
                sc.day,
                period_time_slots.label,
                period_time_slots.start_time,
                period_time_slots.end_time,
                subjects.subject_name,
                employees.firstname,
                employees.lastname
            ')
            ->join('period_time_slots', 'period_time_slots.id = sc.related_period', 'left')
            ->join('subjects', 'subjects.id = sc.related_subject', 'left')
            ->join('employees', 'employees.id = sc.related_teacher', 'left')
            ->where('sc.related_class', $student['related_class'])
            ->where('sc.related_section', $student['related_section'])
            ->orderBy('sc.day', 'ASC')
            ->orderBy('period_time_slots.start_time', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getStudentMarksheetList($studentId)
    {
        $rows = $this->getStudentMarksByExam($studentId);

        $list = [];

        foreach($rows as $examId=>$exam){

            $list[] = [
                'exam_id'=>$examId,
                'exam_title'=>$exam['exam_title'],
                'exam_startdate'=>$exam['exam_startdate'],
                'percentage'=>$exam['percentage'],
                'division'=>$exam['division']
            ];
        }

        return [
            'rows'=>$list,
            'total'=>count($list),
            'pager'=>''
        ];
    }

    public function getStudentMarksheetStats($studentId)
    {
        // reuse existing marks grouping method
        $exams = $this->getStudentMarksByExam($studentId);

        $total = count($exams);

        $percentages = [];

        foreach ($exams as $exam) {
            $percentages[] = $exam['percentage'];
        }

        $average = $total > 0 ? round(array_sum($percentages) / $total, 1) : 0;
        $highest = $total > 0 ? max($percentages) : 0;
        $latest  = $total > 0 ? end($percentages) : 0;

        // prepare exam dropdown list
        $examList = [];

        foreach ($exams as $examId => $exam) {
            $examList[] = [
                'id' => $examId,
                'exam_title' => $exam['exam_title']
            ];
        }

        return [
            'total'   => $total,
            'average' => $average,
            'highest' => $highest,
            'latest'  => $latest,
            'exams'   => $examList
        ];
    }


}
