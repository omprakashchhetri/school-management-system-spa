<?php

namespace App\Controllers\Web\AdminModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;
use App\Controllers\Data\AdminModulePages\ClassesController;
use App\Controllers\Data\AdminModulePages\ClassTeacherManagementController;
use App\Controllers\Data\AdminModulePages\SectionsController;
use App\Controllers\Data\AdminModulePages\SubjectsController;
use App\Controllers\Data\AdminModulePages\ClassTeachersController;
use App\Controllers\Data\AdminModulePages\EmployeeManagementController;
use App\Controllers\Data\AdminModulePages\SubjectAllocationsController;

class AdminModuleController extends BaseController
{


    protected $adminRoleManagementController;
    protected $classesController;
    protected $sectionsController;
    protected $subjectsController;
    protected $classTeacherManagementController;
    protected $classTeachersController;
    protected $employeeManagementController;
    protected $subjectAllocationsController;

    public function __construct(){
        $this->adminRoleManagementController = new AdminRoleManagementController();
        $this->sectionsController = new SectionsController();
        $this->classesController = new ClassesController();
        $this->subjectsController = new SubjectsController();
        $this->classTeacherManagementController = new ClassTeacherManagementController();
        $this->classTeachersController = new ClassTeachersController();
        $this->employeeManagementController = new EmployeeManagementController();
        $this->subjectAllocationsController = new SubjectAllocationsController();
    }
    public function roleManagement() {
        // $adminRoleManagement = new AdminRoleManagementController();
        $sortOption = $this->request->getGet('sortOption');
        if($sortOption != "" && isset($sortOption)){
            $roles = $this->adminRoleManagementController->getListOfRoles($sortOption);    
        } else {
            $roles = $this->adminRoleManagementController->getListOfRoles();
        }
        $passToView = [
            'roles' => $roles,
        ];
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/role-list', $passToView)
        ;
    }

    public function roleToolManagement($roleId) {
        $roleToolManagementData = $this->adminRoleManagementController->getOne($roleId);
        $passToView = [
            'roleDetails' => $roleToolManagementData,
        ];
        // return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/role-tool-management', $passToView)
        ;
    }

    
    public function class_list(): string
    {
        $classesData = $this->classesController->getAll();
        $passToView = [
            'classesDetails' => $classesData,
        ];
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/class-list', $passToView)
        ;
    }

    public function class_teacher_list(): string
    {
        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();
        $employeeList = $this->classTeacherManagementController->getAllEmployees();
        $passToView = [
            'classesDetails' => $classesData,
            'sectionList' => $sectionList,
            'employeeList' => $employeeList,
        ];
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/class-teacher-list', $passToView)            
        ;
    }
    
    public function subject_list(): string
    {
        $subjectsData = $this->subjectsController->getAll();
        $passToView = [
            'subjectsDetails' => $subjectsData,
        ];
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-list', $passToView)
        ;
    }

    public function subject_allocation(): string
    {
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
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-allocation', $passToView)            
        ;
    }

    public function section_list(): string
    {
        $sectionList = $this->sectionsController->getAll();
        $passToView = [
            'sections' => $sectionList,
        ];
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/section-list', $passToView)            
        ;
    }

    public function payment_gateways(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-allocation')            
        ;
    }

    public function employee_details($employeeId) {
        return view('templates/sidebar')
        .  view('templates/topbar')
        .  view('pages/admin-module-pages/employee-details')
        ;
    }

    public function deleteRole() {
        $roleId = $this->request->getPost('id');
        return json_encode($this->adminRoleManagementController->delete($roleId));
    }

    public function addRole() {
        $details = $this->request->getPost();
        return json_encode($this->adminRoleManagementController->add($details));
    }

    public function editRole() {
        $details = $this->request->getPost();
        return json_encode($this->adminRoleManagementController->edit($details['data']));
    }

    public function addClass() {
        $details = $this->request->getPost();
        return json_encode($this->classesController->add($details));
    }

    public function deleteClass() {
        $classId = $this->request->getPost('id');
        return json_encode($this->classesController->delete($classId));
    }

    public function editClass() {
        $details = $this->request->getPost();
        return json_encode($this->classesController->edit($details));
    }
    
    public function addSection() {
        $details = $this->request->getPost();
        return json_encode($this->sectionsController->add($details));
    }

    public function editSection() {
        $details = $this->request->getPost();
        return json_encode($this->sectionsController->edit($details));
    }

    public function deleteSection() {
        $sectionId = $this->request->getPost('id');
        return json_encode($this->sectionsController->delete($sectionId));
    }

    public function addSubject() {
        $details = $this->request->getPost();
        return json_encode($this->subjectsController->add($details));
    }

    public function editSubject() {
        $details = $this->request->getPost();
        return json_encode($this->subjectsController->edit($details));
    }

    public function deleteSubject() {
        $SubjectId = $this->request->getPost('id');
        return json_encode($this->subjectsController->delete($SubjectId));
    }
    
    public function getClassTeacherList(){
        $postData = $this->request->getPost();
        $classTeacherData = $this->classTeacherManagementController->getAll($postData);
        return $classTeacherData;
    }

    public function addClassTeacher() {
        $details = $this->request->getPost();
        return json_encode($this->classTeachersController->add($details));
    }

    public function editClassTeacher() {
        $details = $this->request->getPost();
        return json_encode($this->classTeachersController->edit($details));
    }

    public function deleteClassTeacher() {
        $SubjectId = $this->request->getPost('id');
        return json_encode($this->classTeachersController->delete($SubjectId));
    }

    public function employee_list(): string
    {
        $roles = $this->adminRoleManagementController->getListOfRoles();
        $passToView = [
            'roles' => $roles,
        ];
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/employee-list', $passToView)
        ;
    }

    public function getEmployeeList()
    {
        $postData = $this->request->getPost();
        $classTeacherData = $this->employeeManagementController->getEmployeeList($postData);
        return $classTeacherData;
    }

    public function addEmployee() {
        $details = $this->request->getPost();
        return json_encode($this->employeeManagementController->addEmployee($details));
    }

    public function editEmployee() {
        $details = $this->request->getPost();
        return json_encode($this->employeeManagementController->editEmployee($details));
    }

    public function deleteEmployee() {
        $SubjectId = $this->request->getPost('id');
        return json_encode($this->employeeManagementController->deleteEmployee($SubjectId));
    }

    public function getSubjectAllocationList()
    {
        $postData = $this->request->getPost();
        $classTeacherData = $this->subjectAllocationsController->getSubjectAllocationList($postData);
        return $classTeacherData;
    }

    public function addSubjectAllocation() {
        $details = $this->request->getPost();
        return json_encode($this->subjectAllocationsController->add($details));
    }

    public function editSubjectAllocation() {
        $details = $this->request->getPost();
        return json_encode($this->subjectAllocationsController->edit($details));
    }

    public function deleteSubjectAllocation() {
        $SubjectId = $this->request->getPost('id');
        return json_encode($this->subjectAllocationsController->delete($SubjectId));
    }

}