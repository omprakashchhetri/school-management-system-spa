<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Models\StudentAttendanceModel;
use App\Models\StudentsModel;
use App\Models\AttendanceRecordsModel;
use App\Models\EmployeesModel;

class AttendanceManagementController extends BaseController
{
    protected $attendanceModel;
    protected $studentsModel;
    protected $attendanceRecordsModel;
    protected $employeesModel;

    public function __construct()
    {
        $this->attendanceModel = new StudentAttendanceModel();
        $this->studentsModel = new StudentsModel();
        $this->attendanceRecordsModel = new AttendanceRecordsModel();
        $this->employeesModel = new employeesModel();
    }

    /**
     * Get students for a class & section along with attendance state.
     *
     * @param array $postData
     * @return array
     */
    public function getAttendanceData(array $postData): array
    {
        $classId = $postData['class_id'] ?? null;
        $sectionId = $postData['section_id'] ?? null;
        $date = $postData['date'] ?? null;

        if (!$classId || !$sectionId || !$date) {
            return ['error' => 'Class, Section and Date are required'];
        }

        /* -------------------------------------------------
           1. Fetch students
        ------------------------------------------------- */
        $students = $this->studentsModel
            ->select('id, roll_no, CONCAT(firstname, " ", lastname) AS name')
            ->where('related_class', $classId)
            ->where('related_section', $sectionId)
            ->where('deleted_at', null)
            ->orderBy('roll_no', 'ASC')
            ->findAll();

        if (empty($students)) {
            return [
                'attendance_taken' => false,
                'students' => [],
                'absentees' => []
            ];
        }

        /* -------------------------------------------------
           2. Check attendance_records
        ------------------------------------------------- */
        $attendanceRecord = $this->attendanceRecordsModel
            ->select('attendance_records.*, CONCAT(e.firstname, " ", e.lastname) AS employee_name')
            ->join('employees e', 'e.id = attendance_records.taken_by', 'left')
            ->where('attendance_records.class_id', $classId)
            ->where('attendance_records.section_id', $sectionId)
            ->where('attendance_records.date', $date)
            ->where('attendance_records.deleted_at', null)
            ->first();


        // Attendance NOT taken yet
        if (!$attendanceRecord) {
            return [
                'attendance_taken' => false,
                'students' => $students,
                'absentees' => []
            ];
        }

        /* -------------------------------------------------
           3. Fetch absentees for this attendance record
        ------------------------------------------------- */
        $absentees = $this->attendanceModel
            ->select('student_id')
            ->where('attendance_record_id', $attendanceRecord['id'])
            ->where('status', 'absent')
            ->where('deleted_at', null)
            ->findColumn('student_id');

        return [
            'attendance_taken' => true,
            'attendance_meta' => [
                'taken_at' => $attendanceRecord['taken_at'],
                'taken_by' => $attendanceRecord['employee_name'] ?? 'Former Employee'
            ],
            'students' => $students,
            'absentees' => $absentees
        ];


    }


    /**
     * Save student attendance (absentees only).
     *
     * @param array $postData
     * @return array
     */
    public function saveAttendance(array $postData): array
    {
        $authToken = $postData['auth_token'] ?? null;

        if (!$authToken) {
            return ['error' => 'Authentication token missing'];
        }

        $classId = $postData['class_id'] ?? null;
        $sectionId = $postData['section_id'] ?? null;
        $date = $postData['date'] ?? null;
        $absentees = $postData['absentees'] ?? [];

        if (!$classId || !$sectionId || !$date) {
            return ['error' => 'Class, Section and Date are required'];
        }

        if (!is_array($absentees)) {
            return ['error' => 'Invalid absentees data'];
        }

        $employee = $this->employeesModel
            ->select('id')
            ->where('issued_jwt_token', $authToken)
            ->where('deleted_at', null)
            ->first();

        if (!$employee) {
            return ['error' => 'Invalid or expired authentication token'];
        }

        $employeeId = $employee['id'];


        /* -------------------------------------------------
           1. Get or create attendance_records entry
        ------------------------------------------------- */
        $attendanceRecord = $this->attendanceRecordsModel
            ->where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->where('date', $date)
            ->where('deleted_at', null)
            ->first();

        if (!$attendanceRecord) {

            $attendanceRecordId = $this->attendanceRecordsModel->insert([
                'class_id' => $classId,
                'section_id' => $sectionId,
                'date' => $date,
                'taken_by' => $employeeId,
                'taken_at' => date('Y-m-d H:i:s')
            ]);

        } else {
            $attendanceRecordId = $attendanceRecord['id'];

            // Touch record
            $this->attendanceRecordsModel
                ->set('taken_at', date('Y-m-d H:i:s'))
                ->where('id', $attendanceRecordId)
                ->update();

        }

        /* -------------------------------------------------
           2. Soft delete old absentees
        ------------------------------------------------- */
        $this->attendanceModel
            ->where('attendance_record_id', $attendanceRecordId)
            ->set(['deleted_at' => date('Y-m-d H:i:s')])
            ->update();

        /* -------------------------------------------------
           3. Insert new absentees ONLY
        ------------------------------------------------- */
        if (!empty($absentees)) {

            $studentIds = $this->studentsModel
                ->where('related_class', $classId)
                ->where('related_section', $sectionId)
                ->where('deleted_at', null)
                ->findColumn('id');

            $now = date('Y-m-d H:i:s');
            $insertData = [];

            foreach ($absentees as $studentId) {

                if (!in_array($studentId, $studentIds)) {
                    continue;
                }

                $insertData[] = [
                    'attendance_record_id' => $attendanceRecordId,
                    'student_id' => $studentId,
                    'date' => $date,
                    'status' => 'absent',
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            if (!empty($insertData)) {
                $this->attendanceModel->insertBatch($insertData);
            }
        }

        return ['message' => 'Attendance saved successfully'];
    }


}
