<?php

namespace App\Controllers\Web\AcademicModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\SyllabusManagementController;
use App\Controllers\Data\AdminModulePages\ClassTeacherManagementController;
use App\Controllers\Data\AdminModulePages\SectionsController;
use App\Controllers\Data\AdminModulePages\SubjectsController;
use App\Controllers\Data\AdminModulePages\ClassTeachersController;
use App\Controllers\Data\AdminModulePages\ClassesController;
use App\Controllers\Data\AcademicModulePages\ClassRoutineController;

class SyllabusModuleController extends BaseController
{
    protected $syllabusManagementController;
    protected $classesController;
    protected $sectionsController;
    protected $subjectsController;
    protected $classTeacherManagementController;
    protected $classRoutineController;

    public function __construct()
    {

        $this->syllabusManagementController = new SyllabusManagementController();
        $this->sectionsController = new SectionsController();
        $this->classesController = new ClassesController();
        $this->subjectsController = new SubjectsController();
        $this->classTeacherManagementController = new ClassTeacherManagementController();
        $this->classRoutineController = new ClassRoutineController();
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
        $syllabusDetails = $this->syllabusManagementController->getOneSyllabus($id);

        if (isset($syllabusDetails['error'])) {
            return redirect()->to('post-login-employee/academic/syllabus-list')->with('error', $syllabusDetails['error']);
        }

        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();
        $employeeList = $this->classTeacherManagementController->getAllEmployees();
        $subjectsData = $this->subjectsController->getAll();
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
        $passToView = [
            'classes' => $this->classesController->getAll(),
            'sections' => $this->sectionsController->getAll(),
            'subjects' => $this->subjectsController->getAll(),
            'teachers' => $this->classTeacherManagementController->getAllEmployees(),
        ];
        return view('templates/sidebar-academic')
            .  view('templates/topbar')
            .  view('pages/academic-module-pages/create-class-routine', $passToView)
        ;
    }

    public function class_routine() {
        $passToView = [
            'classes' => $this->classesController->getAll(),
            'sections' => $this->sectionsController->getAll(),
        ];
        return view('templates/sidebar-academic')
            .  view('templates/topbar')
            .  view('pages/academic-module-pages/class-routine', $passToView)
        ;
    }

    public function getClassRoutine()
    {
        $classId = $this->request->getPost('class_id');
        $sectionId = $this->request->getPost('section_id');

        if (!$classId || !$sectionId) {
            return json_encode(['error' => 'Class and section are required']);
        }

        return json_encode($this->classRoutineController->getRoutine($classId, $sectionId));
    }

    public function saveClassRoutine()
    {
        $classId = $this->request->getPost('class_id');
        $sectionId = $this->request->getPost('section_id');
        $periodConfig = $this->request->getPost('period_config') ?? [];
        $entries = $this->request->getPost('entries') ?? [];

        if (!$classId || !$sectionId) {
            return json_encode(['error' => 'Class and section are required']);
        }

        return json_encode($this->classRoutineController->saveRoutine($classId, $sectionId, $periodConfig, $entries));
    }
}