<?php

namespace App\Controllers\Web\AttendanceModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\AttendanceManagementController;
use App\Controllers\Data\AdminModulePages\ClassTeacherManagementController;
use App\Controllers\Data\AdminModulePages\SectionsController;
use App\Controllers\Data\AdminModulePages\SubjectsController;
use App\Controllers\Data\AdminModulePages\ClassesController;

class AttendanceModuleController extends BaseController
{
    protected $attendanceManagementController;
    protected $classesController;
    protected $sectionsController;
    public function __construct()
    {
        
        $this->attendanceManagementController = new AttendanceManagementController();
        $this->sectionsController = new SectionsController();
        $this->classesController = new ClassesController();
    }

   
    public function getAttendanceList() {
        $details = $this->request->getPost();
        return json_encode($this->attendanceManagementController->getAttendanceData($details));
    }

    public function editAttendance() {
        $details = $this->request->getPost();
        return json_encode($this->attendanceManagementController->saveAttendance($details));
    }

    public function addAttendance() {
        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();
        $passToView = [
            'classes' => $classesData,
            'sections' => $sectionList,
        ];
        return view('templates/sidebar-attendance')
            .  view('templates/topbar')
            .  view('pages/attendance-module-pages/student-attendance', $passToView)
        ;
    }

    public function student_details() {
       
        return view('templates/sidebar-attendance')
            .  view('templates/topbar')
            .  view('pages/student-module-pages/student-details')
        ;
    }
}