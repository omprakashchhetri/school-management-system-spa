<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Models\StudentsModel;

class AdmissionController extends BaseController
{
    protected $StudentsModel;

    public function __construct()
    {
        $this->StudentsModel = new StudentsModel();
    }

    /**
     * Get all students
     */
    public function getAll(): array
    {
        return $this->StudentsModel
            ->where('deleted_at', null)
            ->findAll();
    }

    /**
     * Get one student by ID
     */
    public function getOne($id): array
    {
        $record = $this->StudentsModel
            ->where('deleted_at', null)
            ->find($id);

        if (!$record) {
            return ['error' => 'Student not found'];
        }

        return $record;
    }

    
   /**
     * Add new student
     */
    public function add($data = []): array
    {
        // Validate required fields
        if (empty($data['firstname']) || empty($data['lastname'])) {
            return ['error' => 'First name and last name are required'];
        }

        if (empty($data['student_email']) || empty($data['student_contact_no'])) {
            return ['error' => 'Email and contact number are required'];
        }

        if (empty($data['related_class']) || empty($data['related_section'])) {
            return ['error' => 'Class and section are required'];
        }

        // Check if email already exists
        $existingStudent = $this->StudentsModel
            ->where('student_email', $data['student_email'])
            ->where('deleted_at', null)
            ->first();

        if ($existingStudent) {
            return ['error' => 'Email already exists'];
        }

        // DON'T SET ID - let it auto-increment
        // Remove this line: $data['id'] = $this->generateStudentId();
        
        // Generate roll number instead (if you want a custom student identifier)
        $data['roll_no'] = $this->generateStudentId();
        
        // Hash the temporary password
        $data['password'] = 'student@123';
        
        // Set default values for required fields if not provided
        $data['father_name'] = $data['father_name'] ?? '';
        $data['mother_name'] = $data['mother_name'] ?? '';
        $data['father_contact_no'] = $data['father_contact_no'] ?? '';
        $data['profile_image'] = $data['profile_image'] ?? '';
        $data['street'] = $data['street'] ?? '';
        $data['city'] = $data['city'] ?? '';
        $data['pincode'] = $data['pincode'] ?? '';
        $data['district'] = $data['district'] ?? '';
        $data['country'] = $data['country'] ?? 'India';

        // Set timestamps
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Insert student
        if ($this->StudentsModel->insert($data)) {
            // Get the auto-generated ID
            $insertedId = $this->StudentsModel->getInsertID();
            
            return [
                'success' => true, 
                'message' => 'Student admitted successfully', 
                'id' => $insertedId,  // This will be the integer auto-increment ID
                'roll_no' => $data['roll_no']
            ];
        }

        return ['error' => 'Failed to admit student'];
    }

    /**
     * Edit student
     */
    public function edit($data): array
    {
        $id = $data['id'];

        if (!$id) {
            return ['error' => 'Student ID is required'];
        }

        // Find student by integer ID
        $student = $this->StudentsModel->find($id);
        if (!$student) {
            log_message('error', 'Student not found with ID: ' . $id);
            return ['error' => 'Student not found'];
        }

        unset($data['id']);

        // Hash password if provided
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        log_message('debug', 'Updating student ID ' . $id . ' with data: ' . print_r($data, true));

        if ($this->StudentsModel->update($id, $data)) {
            log_message('debug', 'Student updated successfully');
            
            // Verify the update
            $updatedStudent = $this->StudentsModel->find($id);
            log_message('debug', 'Updated student data: ' . print_r($updatedStudent, true));
            
            return ['message' => 'Student updated successfully', 'profile_image' => $updatedStudent['profile_image']];
        }

        log_message('error', 'Failed to update student');
        return ['error' => 'Failed to update student'];
    }

    /**
     * Delete student (soft delete)
     */
    public function delete($id): array
    {
        if (!$id) {
            return ['error' => 'Student ID is required'];
        }

        $student = $this->StudentsModel->find($id);
        if (!$student) {
            return ['error' => 'Student not found'];
        }

        $this->StudentsModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Student deleted successfully'];
    }

    /**
     * Generate unique student ID
     */
    private function generateStudentId(): string
    {
        $year = date('Y');
        $prefix = 'STU' . $year;
        
        $lastStudent = $this->StudentsModel
            ->like('id', $prefix, 'after')
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastStudent) {
            $lastNumber = (int)substr($lastStudent['id'], -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Handle profile image upload
     */
    public function handleProfileUpload($studentId, $file)
    {
        if (!$file->isValid()) {
            return ['error' => 'Invalid file'];
        }

        $newName = $studentId . '_' . $file->getRandomName();
        $uploadPath = FCPATH . 'uploads/students/';
        
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($file->move($uploadPath, $newName)) {
            return ['path' => 'uploads/students/' . $newName];
        }

        return ['error' => 'Failed to upload file'];
    }

    /**
     * Upload student profile image
     */
    public function uploadStudentProfileImage($studentId, $request)
    {
        $student = $this->StudentsModel->find($studentId);
        if (!$student) {
            return ['error' => 'Student not found'];
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
        $newName = 'profile_' . $studentId . '_' . time() . '.' . $img->getExtension();
        
        // Set upload path
        $uploadPath = FCPATH . 'uploads/students/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Delete old image if exists
        if (!empty($student['profile_image'])) {
            $oldImagePath = $uploadPath . basename($student['profile_image']);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Move the file
        if ($img->move($uploadPath, $newName)) {
            // Update database
            $this->StudentsModel->update($studentId, ['profile_image' => $newName]);
            
            return [
                'message' => 'Profile image uploaded successfully',
                'filename' => $newName,
                'url' => base_url('uploads/students/' . $newName)
            ];
        }

        return ['error' => 'Failed to upload image'];
    }
}