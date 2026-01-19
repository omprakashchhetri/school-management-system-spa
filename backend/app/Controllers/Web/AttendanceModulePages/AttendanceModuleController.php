<?php

namespace App\Controllers\Web\AttendanceModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\SyllabusManagementController;
use App\Controllers\Data\AdminModulePages\ClassTeacherManagementController;
use App\Controllers\Data\AdminModulePages\SectionsController;
use App\Controllers\Data\AdminModulePages\SubjectsController;
use App\Controllers\Data\AdminModulePages\ClassTeachersController;
use App\Controllers\Data\AdminModulePages\ClassesController;

class AttendanceModuleController extends BaseController
{
    protected $syllabusManagementController;
    protected $classesController;
    protected $sectionsController;
    protected $subjectsController;
    protected $classTeacherManagementController;
    public function __construct()
    {
        
        $this->syllabusManagementController = new SyllabusManagementController();
        $this->sectionsController = new SectionsController();
        $this->classesController = new ClassesController();
        $this->subjectsController = new SubjectsController();
        $this->classTeacherManagementController = new ClassTeacherManagementController();
    }

   
    public function list() {
       
        return view('templates/sidebar-attendance')
            .  view('templates/topbar')
            .  view('pages/attendance-module-pages/student-attendance-list')
        ;
    }

    public function addAttendance() {
       
        return view('templates/sidebar-attendance')
            .  view('templates/topbar')
            .  view('pages/attendance-module-pages/student-attendance')
        ;
    }

    public function student_details() {
       
        return view('templates/sidebar-attendance')
            .  view('templates/topbar')
            .  view('pages/student-module-pages/student-details')
        ;
    }
}