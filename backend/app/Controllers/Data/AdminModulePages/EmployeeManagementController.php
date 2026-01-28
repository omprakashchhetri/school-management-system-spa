<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;

class EmployeeManagementController extends BaseController
{
    protected $employeeModel;
    protected $subjectAllocationsModel;
    protected $classTeachersModel;
    protected $documentsModel;
    protected $attendanceRecordsModel;
    protected $classesModel;
    protected $sectionsModel;
    protected $subjectsModel;
    protected $rolesModel;

    public function __construct(){
        $this->employeeModel = model('EmployeesModel');
        $this->subjectAllocationsModel = model('SubjectAllocationsModel');
        $this->classTeachersModel = model('ClassTeachersModel');
        $this->documentsModel = model('DocumentsModel');
        $this->attendanceRecordsModel = model('AttendanceRecordsModel');
        $this->classesModel = model('ClassesModel');
        $this->sectionsModel = model('SectionsModel');
        $this->subjectsModel = model('SubjectsModel');
        $this->rolesModel = model('RolesModel');
    }

    public function getEmployeeList($postData)
    {
        $draw   = intval($postData['draw']);
        $start  = intval($postData['start']);
        $length = intval($postData['length']);
        $searchValue = $postData['search']['value'] ?? '';

        $builder = $this->employeeModel->builder()
            ->select('employees.id, employees.firstname, employees.lastname, employees.email1, employees.contact_number1, employees.profile_image, employees.created_at, r.role_name, employees.role_id')
            ->join('roles r', 'r.id = employees.role_id', 'left')
            ->where('employees.deleted_at', null);

        // Searching
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('employees.firstname', $searchValue)
                ->orLike('employees.lastname', $searchValue)
                ->orLike('employees.email1', $searchValue)
                ->orLike('employees.contact_number1', $searchValue)
                ->orLike('r.role_name', $searchValue)
                ->groupEnd();
        }

        // Ordering
        if (isset($postData['order'])) {
            $colIndex = $postData['order'][0]['column'];
            $colDir   = $postData['order'][0]['dir'];
            $columns  = [
                'employees.id',
                'employees.firstname',
                'employees.email1',
                'employees.contact_number1',
                'r.role_name',
                'employees.created_at'
            ];
            if (isset($columns[$colIndex])) {
                $builder->orderBy($columns[$colIndex], $colDir);
            }
        } else {
            $builder->orderBy('employees.id', 'DESC');
        }

        // Pagination
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $query   = $builder->get();
        $records = $query->getResult();

        // For DataTables
        $totalFiltered = $builder->countAllResults(false);
        $totalRecords  = $this->employeeModel->builder()
                            ->where('deleted_at', null)
                            ->countAllResults();

        $data = [];
        foreach ($records as $row) {
            $fullName = trim($row->firstname . ' ' . $row->lastname);
            $photo = !empty($row->profile_image) 
                ? base_url('uploads/employees/'.$row->profile_image) 
                : base_url('assets/images/thumbs/student-img1.png');

            $data[] = [
                'checkbox'   => '<input type="checkbox" value="'.$row->id.'" class="form-check-input">',
                'name'       => '<div class="flex-align gap-8 nav_js" data-route="admin/employee-details/'.$row->id.'">
                                    <img src="'.$photo.'" alt="" class="w-40 h-40 rounded-circle" />
                                    <span class="h6 mb-0 fw-medium text-gray-300">'.$fullName.'</span>
                                </div>',
                'email'      => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->email1.'</span>',
                'phone'      => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->contact_number1.'</span>',
                'role'       => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->role_name.'</span>',
                'created_at' => '<span class="h6 mb-0 fw-medium text-gray-300">'.date("M d, Y", strtotime($row->created_at)).'</span>',
                'actions'    => '<button 
                                    data-id="'.$row->id.'" 
                                    data-firstname="'.$row->firstname.'" 
                                    data-lastname="'.$row->lastname.'" 
                                    data-email="'.$row->email1.'" 
                                    data-phone="'.$row->contact_number1.'" 
                                    data-role="'.$row->role_id.'" 
                                    class="edit-employee-js bg-warning-50 text-warning-600 py-2 px-14 rounded-pill">
                                        Edit
                                    </button>
                                    <button data-id="'.$row->id.'" 
                                    class="delete-employee-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill">
                                        Delete
                                    </button>'
            ];
            
        }

        return service('response')->setJSON([
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
    }

    public function addEmployee($data): array
    {
        if ($this->employeeModel->insert($data)) {
            return ['message' => 'Employee added successfully'];
        }
        return ['error' => 'Failed to add employee'];
    }

    public function editEmployee($data): array
    {
        $id = $data['id'] ?? null;
        if (!$id) return ['error' => 'Employee ID required'];

        unset($data['id']); // avoid overwriting PK
        if ($this->employeeModel->update($id, $data)) {
            return ['message' => 'Employee updated successfully'];
        }
        return ['error' => 'Failed to update employee'];
    }

    public function deleteEmployee($id): array
    {
        if (!$id) return ['error' => 'Employee ID required'];

        $record = $this->employeeModel->find($id);
        if (!$record) return ['error' => 'Employee not found'];

        $this->employeeModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Employee deleted successfully'];
    }

    public function getEmployeeDetails($employeeId) 
    {
        // Get basic employee details
        $employee = $this->employeeModel
            ->select('employees.*, r.role_name')
            ->join('roles r', 'r.id = employees.role_id', 'left')
            ->where('employees.id', $employeeId)
            ->where('employees.deleted_at', null)
            ->first();

        if (!$employee) {
            return null;
        }

        // Exclude sensitive information
        unset($employee['password']);
        unset($employee['issued_jwt_token']);

        // Get subject allocations with details
        $subjectAllocations = $this->subjectAllocationsModel->builder()
            ->select('subject_allocations.*, c.class_name, s.section_label, sub.subject_name')
            ->join('classes c', 'c.id = subject_allocations.class', 'left')
            ->join('sections s', 's.id = subject_allocations.section', 'left')
            ->join('subjects sub', 'sub.id = subject_allocations.subject', 'left')
            ->where('subject_allocations.teacher', $employeeId)
            ->where('subject_allocations.deleted_at', null)
            ->get()
            ->getResultArray();

        // Get class teacher assignments
        $classTeacherAssignments = $this->classTeachersModel->builder()
            ->select('class_teachers.*, c.class_name, s.section_label')
            ->join('classes c', 'c.id = class_teachers.class', 'left')
            ->join('sections s', 's.id = class_teachers.section', 'left')
            ->where('class_teachers.teacher', $employeeId)
            ->where('class_teachers.deleted_at', null)
            ->get()
            ->getResultArray();

        // Count students in each class teacher assignment
        $studentsModel = model('StudentsModel');
        foreach ($classTeacherAssignments as &$assignment) {
            $studentCount = $studentsModel->builder()
                ->where('related_class', $assignment['class'])
                ->where('related_section', $assignment['section'])
                ->where('deleted_at', null)
                ->countAllResults();
            $assignment['student_count'] = $studentCount;
        }

        // Get documents
        $documents = $this->documentsModel->builder()
            ->where('related_teacher', $employeeId)
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();

        // Get recent attendance records (last 30 days)
        $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));
        $attendanceRecords = $this->attendanceRecordsModel->builder()
            ->select('attendance_records.*, c.class_name, s.section_label')
            ->join('classes c', 'c.id = attendance_records.class_id', 'left')
            ->join('sections s', 's.id = attendance_records.section_id', 'left')
            ->where('attendance_records.taken_by', $employeeId)
            ->where('attendance_records.date >=', $thirtyDaysAgo)
            ->where('attendance_records.deleted_at', null)
            ->orderBy('attendance_records.date', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        // Calculate attendance statistics (mock for now - you can enhance this)
        $attendanceStats = [
            'present_days' => 22,
            'absent_days' => 2,
            'late_arrivals' => 1,
            'attendance_rate' => 92
        ];

        return [
            'employee' => $employee,
            'subject_allocations' => $subjectAllocations,
            'class_teacher_assignments' => $classTeacherAssignments,
            'documents' => $documents,
            'attendance_records' => $attendanceRecords,
            'attendance_stats' => $attendanceStats
        ];
    }

    public function updateEmployeeDetails($data): array
    {
        $employeeId = $data['employee_id'] ?? null;
        if (!$employeeId) {
            return ['error' => 'Employee ID required'];
        }

        $employee = $this->employeeModel->find($employeeId);
        if (!$employee) {
            return ['error' => 'Employee not found'];
        }

        // Prepare update data
        $updateData = [];
        
        // Personal Information
        if (isset($data['firstname'])) $updateData['firstname'] = $data['firstname'];
        if (isset($data['lastname'])) $updateData['lastname'] = $data['lastname'];
        if (isset($data['middlename'])) $updateData['middlename'] = $data['middlename'];
        if (isset($data['email1'])) $updateData['email1'] = $data['email1'];
        if (isset($data['email2'])) $updateData['email2'] = $data['email2'];
        if (isset($data['contact_number1'])) $updateData['contact_number1'] = $data['contact_number1'];
        if (isset($data['contact_number2'])) $updateData['contact_number2'] = $data['contact_number2'];
        if (isset($data['street'])) $updateData['street'] = $data['street'];
        if (isset($data['city'])) $updateData['city'] = $data['city'];
        if (isset($data['district'])) $updateData['district'] = $data['district'];
        if (isset($data['pincode'])) $updateData['pincode'] = $data['pincode'];
        if (isset($data['country'])) $updateData['country'] = $data['country'];
        
        // Professional Information
        if (isset($data['role_id'])) $updateData['role_id'] = $data['role_id'];

        if (empty($updateData)) {
            return ['error' => 'No data to update'];
        }

        if ($this->employeeModel->update($employeeId, $updateData)) {
            return ['message' => 'Employee details updated successfully'];
        }

        return ['error' => 'Failed to update employee details'];
    }

    public function uploadEmployeeImage($employeeId, $imageType = 'profile', $request)
    {
        $employee = $this->employeeModel->find($employeeId);
        if (!$employee) {
            return ['error' => 'Employee not found'];
        }

        $validationRule = [
            'image' => [
                'label' => 'Image File',
                'rules' => 'uploaded[image]'
                    . '|is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]'
                    . '|max_size[image,2048]', // 2MB max
            ],
        ];

        $validation = \Config\Services::validation();
        
        if (!$validation->setRules($validationRule)->withRequest($request)->run()) {
            return ['error' => $validation->getErrors()];
        }

        $img = $request->getFile('image');
        
        if (!$img || !$img->isValid()) {
            return ['error' => 'Invalid file upload'];
        }

        // Generate unique filename
        $newName = $imageType . '_' . $employeeId . '_' . time() . '.' . $img->getExtension();
        
        // Set upload path
        $uploadPath = FCPATH . 'uploads/employees/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Delete old image if exists
        if ($imageType === 'profile' && !empty($employee['profile_image'])) {
            $oldImagePath = $uploadPath . $employee['profile_image'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Move the file
        if ($img->move($uploadPath, $newName)) {
            // Update database
            if ($imageType === 'profile') {
                $this->employeeModel->update($employeeId, ['profile_image' => $newName]);
            }
            
            return [
                'message' => ucfirst($imageType) . ' image uploaded successfully',
                'filename' => $newName,
                'url' => base_url('uploads/employees/' . $newName)
            ];
        }

        return ['error' => 'Failed to upload image'];
    }

    public function uploadEmployeeDocument($data, $request)
    {
        $employeeId = $data['employee_id'];
        $documentType = $data['document_type'];
        $documentName = $data['document_name'];

        $employee = $this->employeeModel->find($employeeId);
        if (!$employee) {
            return ['error' => 'Employee not found'];
        }

        $validationRule = [
            'document' => [
                'label' => 'Document File',
                'rules' => 'uploaded[document]'
                    . '|ext_in[document,pdf,doc,docx,jpg,jpeg,png]'
                    . '|max_size[document,5120]', // 5MB max
            ],
        ];

        $validation = \Config\Services::validation();
        
        if (!$validation->setRules($validationRule)->withRequest($request)->run()) {
            return ['error' => $validation->getErrors()];
        }

        $file = $request->getFile('document');
        
        if (!$file || !$file->isValid()) {
            return ['error' => 'Invalid file upload'];
        }

        // Generate unique filename
        $newName = 'doc_' . $employeeId . '_' . time() . '.' . $file->getExtension();
        
        // Set upload path
        $uploadPath = FCPATH . 'uploads/employees/documents/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Move the file
        if ($file->move($uploadPath, $newName)) {
            // Save to database
            $documentsModel = model('DocumentsModel');
            
            $documentData = [
                'document_name' => $documentName,
                'document_type' => $documentType,
                'file' => $newName,
                'file_size' => $file->getSize(),
                'related_teacher' => $employeeId,
                'status' => 'pending'
            ];
            
            if ($documentsModel->insert($documentData)) {
                return [
                    'message' => 'Document uploaded successfully',
                    'filename' => $newName,
                    'document_id' => $documentsModel->getInsertID()
                ];
            }
            
            // If database insert fails, delete the uploaded file
            unlink($uploadPath . $newName);
            return ['error' => 'Failed to save document information'];
        }

        return ['error' => 'Failed to upload document'];
    }

    public function deleteEmployeeDocument($documentId)
    {
        $documentsModel = model('DocumentsModel');
        $document = $documentsModel->find($documentId);
        
        if (!$document) {
            return ['error' => 'Document not found'];
        }

        // Delete physical file
        $filePath = FCPATH . 'uploads/employees/documents/' . $document['file'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Soft delete from database
        if ($documentsModel->delete($documentId)) {
            return ['message' => 'Document deleted successfully'];
        }

        return ['error' => 'Failed to delete document'];
    }

    public function updateDocumentStatus($documentId, $status)
    {
        if (!in_array($status, ['pending', 'verified', 'rejected'])) {
            return ['error' => 'Invalid status'];
        }

        $documentsModel = model('DocumentsModel');
        $document = $documentsModel->find($documentId);
        
        if (!$document) {
            return ['error' => 'Document not found'];
        }

        if ($documentsModel->update($documentId, ['status' => $status])) {
            return ['message' => 'Document status updated successfully'];
        }

        return ['error' => 'Failed to update document status'];
    }

    public function getDocumentForDownload($documentId)
    {
        $documentsModel = model('DocumentsModel');
        $document = $documentsModel->find($documentId);
        
        if (!$document) {
            return null;
        }

        $filePath = FCPATH . 'uploads/employees/documents/' . $document['file'];
        
        if (!file_exists($filePath)) {
            return null;
        }

        return [
            'filepath' => $filePath,
            'filename' => $document['document_name'] . '.' . pathinfo($document['file'], PATHINFO_EXTENSION)
        ];
    }
}