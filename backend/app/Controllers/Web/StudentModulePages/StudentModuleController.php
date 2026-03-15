<?php

namespace App\Controllers\Web\StudentModulePages;

use App\Controllers\BaseController;
use App\Controllers\Data\StudentsController;
use CodeIgniter\HTTP\ResponseInterface;

class StudentModuleController extends BaseController
{
    protected $studentsController;

    public function __construct()
    {
        $this->studentsController = new StudentsController();
    }

    public function dashboard(): string
    {
        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-dashboard')
            . view('templates/footer-student');
    }

    /**
     * Student profile / details page.
     * Passes all tab data in one shot so every tab is immediately usable.
     */
    public function profile(): string|ResponseInterface
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int) $this->request->user->id;

        // ── Core student record ───────────────────────────────────────────
        $studentData = $this->studentsController->getStudentById($studentId);

        if (empty($studentData)) {
            return redirect()->to('/student/login');
        }

        // ── Attendance ────────────────────────────────────────────────────
        $attendance = $this->studentsController->getStudentAttendance($studentId, 10);
        $attendanceSummary = $this->studentsController->getStudentAttendanceSummary($studentId);

        // ── Fees ──────────────────────────────────────────────────────────
        $fees = $this->studentsController->getStudentFees($studentId, 10);

        // ── Assignments ───────────────────────────────────────────────────
        $assignments = $this->studentsController->getStudentAssignments($studentId, 10);
        $assignmentStats = $this->studentsController->getStudentAssignmentStats($studentId);
        $assignmentSubjects = $this->studentsController->getAssignmentSubjects($studentId);

        // ── Marks (flat) & Marksheets (grouped by exam) ───────────────────
        $marks = $this->studentsController->getStudentMarks($studentId, 10);
        $marksByExam = $this->studentsController->getStudentMarksByExam($studentId);

        // ── Documents ─────────────────────────────────────────────────────
        $documents = $this->studentsController->getStudentDocuments($studentId, 10);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-details', [
                'studentData' => $studentData,
                'attendance' => $attendance,
                'attendanceSummary' => $attendanceSummary,
                'fees' => $fees,
                'assignments' => $assignments,
                'assignmentStats' => $assignmentStats,
                'assignmentSubjects' => $assignmentSubjects,
                'marks' => $marks,
                'marksByExam' => $marksByExam,
                'documents' => $documents,
            ])
            . view('templates/footer-student');
    }

    // ─────────────────────────────────────────────
    // ATTENDANCE PAGE
    // ─────────────────────────────────────────────

    public function attendance(): string|ResponseInterface
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int) $this->request->user->id;

        $attendance = $this->studentsController->getStudentAttendance($studentId, 20);

        $summary = $this->studentsController->getStudentAttendanceSummary($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-attendance-list', [
                'attendance' => $attendance,
                'summary' => $summary
            ])
            . view('templates/footer-student');
    }


    public function document_list(): string
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int) $this->request->user->id;

        $studentsController = new \App\Controllers\Data\StudentsController();

        $sort = $this->request->getGet('doc_sort') ?? 'latest';

        $documents = $studentsController->getStudentDocuments($studentId, 10, $sort);

        // NEW
        $documentStats = $studentsController->getStudentDocumentStats($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/document-list', [
                'documents' => $documents,
                'stats' => $documentStats
            ])
            . view('templates/footer-student');
    }

    // ─────────────────────────────────────────────
    // ASSIGNMENT LIST PAGE
    // ─────────────────────────────────────────────

    public function assignments(): string|ResponseInterface
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int) $this->request->user->id;

        $assignments = $this->studentsController
            ->getStudentAssignments($studentId, 15);

        $stats = $this->studentsController
            ->getStudentAssignmentStats($studentId);

        $subjects = $this->studentsController
            ->getAssignmentSubjects($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-assignment-list', [
                'assignments' => $assignments,
                'stats' => $stats,
                'subjects' => $subjects
            ])
            . view('templates/footer-student');
    }


    // ─────────────────────────────────────────────
    // ASSIGNMENT DETAILS
    // ─────────────────────────────────────────────

    public function assignment($assignmentId)
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int) $this->request->user->id;

        $assignment = $this->studentsController
            ->getAssignmentDetails($assignmentId, $studentId);

        if (!$assignment) {
            return redirect()->to('assignments');
        }

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-assignment-details', [
                'assignment' => $assignment
            ])
            . view('templates/footer-student');
    }


    // ─────────────────────────────────────────────
    // SUBJECT LIST
    // ─────────────────────────────────────────────

    public function subjects(): string|ResponseInterface
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int) $this->request->user->id;

        $subjects = $this->studentsController->getStudentSubjects($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/subject-list', [
                'subjects' => $subjects
            ])
            . view('templates/footer-student');
    }


    // ─────────────────────────────────────────────
    // FEES PAGE
    // ─────────────────────────────────────────────

    public function fees(): string|ResponseInterface
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int)$this->request->user->id;

        $fees = $this->studentsController
            ->getStudentFees($studentId,15);

        $stats = $this->studentsController
            ->getStudentFeeStats($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-fee-list',[
                'fees'=>$fees,
                'stats'=>$stats
            ])
            . view('templates/footer-student');
    }



    public function marksheets()
    {
        $studentId = (int)$this->request->user->id;

        $marksheets = $this->studentsController
            ->getStudentMarksheetList($studentId);

        $stats = $this->studentsController
            ->getStudentMarksheetStats($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-marksheet-list',[
                'marksheets'=>$marksheets,
                'stats'=>$stats
            ])
            . view('templates/footer-student');
    }

    public function marksheet($examId)
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int)$this->request->user->id;

        $studentData = $this->studentsController->getStudentById($studentId);

        $marksByExam = $this->studentsController->getStudentMarksByExam($studentId);

        if (!isset($marksByExam[$examId])) {
            return redirect()->to('/student/report-cards');
        }

        $exam = $marksByExam[$examId];

        $attendanceSummary = $this->studentsController->getStudentAttendanceSummary($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/student-marksheet-details', [
                'studentData' => $studentData,
                'exam' => $exam,
                'allExams' => $marksByExam,
                'attendanceSummary' => $attendanceSummary
            ])
            . view('templates/footer-student');
    }



    // ─────────────────────────────────────────────
    // SCHEDULE PAGE
    // ─────────────────────────────────────────────

    public function schedule(): string|ResponseInterface
    {
        if (!isset($this->request->user->id)) {
            return redirect()->to('/student/login');
        }

        $studentId = (int) $this->request->user->id;

        $schedule = $this->studentsController->getStudentSchedule($studentId);

        return view('templates/header-student')
            . view('templates/sidebar-student')
            . view('templates/topbar-student')
            . view('pages/student-module-pages/schedule', [
                'schedule' => $schedule
            ])
            . view('templates/footer-student');
    }


}
