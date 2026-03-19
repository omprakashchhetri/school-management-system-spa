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
use App\Controllers\Data\AdminModulePages\AdmissionController;

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
    protected $admissionController;

    public function __construct(){
        $this->adminRoleManagementController = new AdminRoleManagementController();
        $this->sectionsController = new SectionsController();
        $this->classesController = new ClassesController();
        $this->subjectsController = new SubjectsController();
        $this->classTeacherManagementController = new ClassTeacherManagementController();
        $this->classTeachersController = new ClassTeachersController();
        $this->employeeManagementController = new EmployeeManagementController();
        $this->subjectAllocationsController = new SubjectAllocationsController();
        $this->admissionController = new AdmissionController();
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

    public function employee_details($employeeId)
    {
        
        $employeeData = $this->employeeManagementController->getEmployeeDetails($employeeId);
        if (!$employeeData) {
            return redirect()->to('admin/employee-list')->with('error', 'Employee not found');
        }
            
        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();
        $employeeList = $this->classTeacherManagementController->getAllEmployees();
        $subjectsData = $this->subjectsController->getAll();
        $roleDetails = $this->adminRoleManagementController->getOne($employeeData['employee']['role_id']);
        $passToView = [
            'classes' => $classesData,
            'sections' => $sectionList,
            'teachers' => $employeeList,
            'subjects' => $subjectsData,
            'employeeDetails' => $employeeData, 
            'roleDetails' => $roleDetails
        ];
        
        return view('templates/sidebar')
            . view('templates/topbar')
            . view('pages/admin-module-pages/employee-details', $passToView);
    }

    // Edit employee details AJAX function
    public function updateEmployeeDetails() {
        $details = $this->request->getPost();
        return json_encode($this->employeeManagementController->updateEmployeeDetails($details));
    }

    // Upload employee images AJAX functions
   public function uploadEmployeeProfileImage() 
    {
        $employeeId = $this->request->getPost('employee_id');
        
        if (!$employeeId) {
            return json_encode(['error' => 'Employee ID required']);
        }
        
        return json_encode($this->employeeManagementController->uploadEmployeeImage($employeeId, 'profile', $this->request));
    }

    // Upload employee cover image AJAX function
    public function uploadEmployeeCoverImage() 
    {
        $employeeId = $this->request->getPost('employee_id');
        
        if (!$employeeId) {
            return json_encode(['error' => 'Employee ID required']);
        }
        
        return json_encode($this->employeeManagementController->uploadEmployeeImage($employeeId, 'cover', $this->request));
    }

    public function uploadEmployeeDocument() 
    {
        $employeeId = $this->request->getPost('employee_id');
        $documentType = $this->request->getPost('document_type');
        $documentName = $this->request->getPost('document_name');
        
        if (!$employeeId) {
            return json_encode(['error' => 'Employee ID required']);
        }

        if (!$documentType) {
            return json_encode(['error' => 'Document type required']);
        }

        if (!$documentName) {
            return json_encode(['error' => 'Document name required']);
        }

        $data = [
            'employee_id' => $employeeId,
            'document_type' => $documentType,
            'document_name' => $documentName
        ];

        return json_encode($this->employeeManagementController->uploadEmployeeDocument($data, $this->request));
    }

    public function deleteEmployeeDocument() 
    {
        $documentId = $this->request->getPost('document_id');
        
        if (!$documentId) {
            return json_encode(['error' => 'Document ID required']);
        }

        return json_encode($this->employeeManagementController->deleteEmployeeDocument($documentId));
    }

    public function updateDocumentStatus() 
    {
        $documentId = $this->request->getPost('document_id');
        $status = $this->request->getPost('status');
        
        if (!$documentId || !$status) {
            return json_encode(['error' => 'Document ID and status required']);
        }

        return json_encode($this->employeeManagementController->updateDocumentStatus($documentId, $status));
    }

    public function downloadEmployeeDocument($documentId)
    {
        $documentData = $this->employeeManagementController->getDocumentForDownload($documentId);
        
        if (!$documentData) {
            return redirect()->back()->with('error', 'Document or file not found');
        }

        return $this->response->download($documentData['filepath'], null)->setFileName($documentData['filename']);
    }

    // View Module Page Functions
    public function view_modules(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/view-modules')
        ;
    }
    
    // AJAX Function Starts
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

    public function getSubjectList() {        
        return json_encode($this->subjectsController->getAll());
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


    /**
     * Add these methods to your existing AdminModuleController.php
     * Location: app/Controllers/Web/AdminModulePages/AdminModuleController.php
     */

    // ============================================
    // ADMISSION METHODS - Add to AdminModuleController
    // ============================================

    /**
     * Display admission form
     */
    public function createAdmission() {
        $passToView = [
            'title' => 'Student Admission',
        ];
        return view('templates/sidebar', $passToView)
            . view('templates/topbar')
            . view('pages/admin-module-pages/create-admission');
    }

    /**
     * Add new student admission
     */
    public function addStudent() {
        log_message('debug', '=== STUDENT ADMISSION START ===');
        
        $details = $this->request->getPost();
        log_message('debug', 'POST Data: ' . print_r($details, true));
        
        // Check if file exists
        $file = $this->request->getFile('profile_image');
        log_message('debug', 'File exists: ' . ($file ? 'YES' : 'NO'));
        
        if ($file) {
            log_message('debug', 'File name: ' . $file->getName());
            log_message('debug', 'File is valid: ' . ($file->isValid() ? 'YES' : 'NO'));
            log_message('debug', 'File has moved: ' . ($file->hasMoved() ? 'YES' : 'NO'));
            log_message('debug', 'File error: ' . $file->getErrorString());
        }
        
        // First, add the student
        $result = $this->admissionController->add($details);
        log_message('debug', 'Add student result: ' . print_r($result, true));
        
        // If student added successfully, handle image upload
        if (isset($result['success']) && $result['success'] && isset($result['id'])) {
            $studentId = $result['id'];
            log_message('debug', 'Student ID: ' . $studentId);
            
            if ($file && $file->isValid() && !$file->hasMoved()) {
                log_message('debug', 'Starting image upload...');
                
                // Generate unique filename
                $newName = 'profile_' . $studentId . '_' . time() . '.' . $file->getExtension();
                log_message('debug', 'New filename: ' . $newName);
                
                // Set upload path
                $uploadPath = FCPATH . 'uploads/students/';
                log_message('debug', 'Upload path: ' . $uploadPath);
                
                // Create directory if it doesn't exist
                if (!is_dir($uploadPath)) {
                    log_message('debug', 'Creating directory...');
                    mkdir($uploadPath, 0777, true);
                }
                
                log_message('debug', 'Directory exists: ' . (is_dir($uploadPath) ? 'YES' : 'NO'));
                log_message('debug', 'Directory writable: ' . (is_writable($uploadPath) ? 'YES' : 'NO'));

                // Move the file
                if ($file->move($uploadPath, $newName)) {
                    log_message('debug', 'File moved successfully!');
                    
                    // Update student record with image filename
                    $updateResult = $this->admissionController->edit([
                        'id' => $studentId,
                        'profile_image' => $newName
                    ]);
                    log_message('debug', 'Update result: ' . print_r($updateResult, true));
                    
                    $result['image_uploaded'] = true;
                    $result['image_name'] = $newName;
                } else {
                    log_message('error', 'Failed to move file!');
                    log_message('error', 'File error: ' . $file->getErrorString());
                    $result['image_error'] = 'Failed to move file: ' . $file->getErrorString();
                }
            } else {
                log_message('debug', 'File validation failed or file already moved');
                if ($file) {
                    log_message('debug', 'File valid: ' . ($file->isValid() ? 'YES' : 'NO'));
                    log_message('debug', 'File moved: ' . ($file->hasMoved() ? 'YES' : 'NO'));
                    log_message('debug', 'File error: ' . $file->getErrorString());
                }
            }
        }
        
        log_message('debug', 'Final result: ' . print_r($result, true));
        log_message('debug', '=== STUDENT ADMISSION END ===');
        
        return json_encode($result);
    }

    /**
     * Upload student profile image (separate AJAX endpoint)
     */
    public function uploadStudentProfileImage() 
    {
        $studentId = $this->request->getPost('student_id');
        
        if (!$studentId) {
            return json_encode(['error' => 'Student ID required']);
        }
        
        return json_encode($this->admissionController->uploadStudentProfileImage($studentId, $this->request));
    }

    /**
     * Get all students
     */
    public function getStudents() {
        return json_encode($this->admissionController->getAll());
    }

    /**
     * Edit student
     */
    public function editStudent() {
        $details = $this->request->getPost();
        return json_encode($this->admissionController->edit($details));
    }

    /**
     * Delete student
     */
    public function deleteStudent() {
        $id = $this->request->getPost('id');
        return json_encode($this->admissionController->delete($id));
    }

    /**
     * Get classes for dropdown
     */
    public function getClasses() {
        return json_encode($this->classesController->getAll());
    }

    /**
     * Get sections by class for dropdown
     */
    public function getSections() {        
        
        $sections = $this->sectionsController->getAll();

        return json_encode(array_values($sections));
    }
}