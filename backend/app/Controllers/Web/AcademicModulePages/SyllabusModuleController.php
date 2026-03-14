<?php

namespace App\Controllers\Web\AcademicModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\SyllabusManagementController;
use App\Controllers\Data\AdminModulePages\ClassTeacherManagementController;
use App\Controllers\Data\AdminModulePages\SectionsController;
use App\Controllers\Data\AdminModulePages\SubjectsController;
use App\Controllers\Data\AdminModulePages\ClassTeachersController;
use App\Controllers\Data\AdminModulePages\ClassesController;

class SyllabusModuleController extends BaseController
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

    public function getSyllabusList()
    {
        $postData = $this->request->getPost();

        return $this->syllabusManagementController->getSyllabusList($postData);
    }
    public function list() {
        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();
        $employeeList = $this->classTeacherManagementController->getAllEmployees();
        $subjectsData = $this->subjectsController->getAll();
        $passToView = [
            'classes' => $classesData,
            'sections' => $sectionList,
            'teachers' => $employeeList,
            'subjects' => $subjectsData,
        ];
        return view('templates/sidebar-academic')
            .  view('templates/topbar')
            .  view('pages/academic-module-pages/syllabus-list', $passToView)
        ;
    }

    public function add_edit() {
        return view('templates/sidebar-employee')
            .  view('templates/topbar')
            .  view('pages/employee-module-pages/employee-list')
        ;
    }

    public function syllabusDetails($id) {
        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();
        $employeeList = $this->classTeacherManagementController->getAllEmployees();
        $subjectsData = $this->subjectsController->getAll();
        $syllabusDetails = $this->syllabusManagementController->getOneSyllabus($id);
        $passToView = [
            'classes' => $classesData,
            'sections' => $sectionList,
            'teachers' => $employeeList,
            'subjects' => $subjectsData,
            'syllabusDetails' => $syllabusDetails,
        ];
        return view('templates/sidebar-academic')
            .  view('templates/topbar')
            .  view('pages/academic-module-pages/syllabus-details', $passToView)
        ;
    }

    public function addSyllabus() {
        $details = $this->request->getPost();
        return json_encode($this->syllabusManagementController->addSyllabus($details));
    }

    public function editSyllabus() {
        $details = $this->request->getPost();
        return json_encode($this->syllabusManagementController->editSyllabus($details));
    }

    public function deleteSyllabus() {
        $SubjectId = $this->request->getPost('id');
        return json_encode($this->syllabusManagementController->deleteSyllabus($SubjectId));
    }

     public function add_edit_class_routine() {
        return view('templates/sidebar-academic')
            .  view('templates/topbar')
            .  view('pages/academic-module-pages/create-class-routine')
        ;
    }
    
    public function class_routine() {
        return view('templates/sidebar-academic')
            .  view('templates/topbar')
            .  view('pages/academic-module-pages/class-routine')
        ;
    }
}