<?php

namespace App\Controllers\Web\AdminModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;
use App\Controllers\Data\AdminModulePages\ClassesController;
use App\Controllers\Data\AdminModulePages\ClassTeacherManagementController;
use App\Controllers\Data\AdminModulePages\SectionsController;
use App\Controllers\Data\AdminModulePages\SubjectsController;

class AdminModuleController extends BaseController
{


    protected $adminRoleManagementController;
    protected $classesController;
    protected $sectionsController;
    protected $subjectsController;
    protected $classTeacherManagementController;

    public function __construct(){
        $this->adminRoleManagementController = new AdminRoleManagementController();
        $this->sectionsController = new SectionsController();
        $this->classesController = new ClassesController();
        $this->subjectsController = new SubjectsController();
        $this->classTeacherManagementController = new ClassTeacherManagementController();
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
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/class-teacher-list')            
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
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-allocation')            
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

}