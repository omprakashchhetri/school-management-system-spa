<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;

class ClassTeacherManagementController extends BaseController
{
    protected $classTeacherModel;
    public function __construct(){
        $this->classTeacherModel = model('ClassTeachersModel');
    }

    public function getAll($postData) 
    {
        $draw   = intval($postData['draw']);
        $start  = intval($postData['start']);
        $length = intval($postData['length']);
        $searchValue = $postData['search']['value'] ?? '';

        // Base query: join tables
        $builder = $this->classTeacherModel->builder()
            ->select('class_teachers.id, class_teachers.class, class_teachers.section, class_teachers.teacher, class_teachers.created_at, class_teachers.updated_at, 
                    c.class_name, s.section_label, 
                    e.firstname, e.lastname, e.profile_image as teacher_photo, c.id AS class_id, s.id AS section_id, e.id AS employee_id')
            ->join('classes c', 'c.id = class_teachers.class', 'left')
            ->join('sections s', 's.id = class_teachers.section', 'left')
            ->join('employees e', 'e.id = class_teachers.teacher', 'left')
            ->where('class_teachers.deleted_at', null);

        // Searching
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('e.firstname', $searchValue)
                ->orLike('e.lastname', $searchValue)
                ->orLike('c.class_name', $searchValue)
                ->orLike('s.section_label', $searchValue)
                ->groupEnd();
        }

        // Ordering
        if (isset($postData['order'])) {
            $colIndex = $postData['order'][0]['column'];
            $colDir   = $postData['order'][0]['dir'];
            $columns  = [
                'class_teachers.id',
                'e.firstname',  // teacher
                'c.class_name', // class
                's.section_label', // section
                'class_teachers.created_at',
                'class_teachers.updated_at'
            ];
            $builder->orderBy($columns[$colIndex], $colDir);
        } else {
            $builder->orderBy('class_teachers.id', 'DESC');
        }

        // Pagination
        if ($length != -1) {
            $builder->limit($length, $start);
        }
        
        $query = $builder->get();
        $records = $query->getResult();

        // Total records after filtering
        $totalFiltered = $builder->countAllResults(false);
        
        // Total records before filtering
        $totalRecords = $this->classTeacherModel->builder()
            ->countAllResults();


        // Format data for DataTable
        $data = [];
        foreach ($records as $row) {
            $teacherFullName = trim($row->firstname . ' ' . $row->lastname);

            $data[] = [
                'checkbox'   => '<input type="checkbox" class="form-check-input" value="'.$row->id.'">',
                'teacher'    => '<div class="flex-align gap-8">
                                    <img src="'. base_url() .'assets/images/thumbs/student-img1.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                    <span class="h6 mb-0 fw-medium text-gray-300">'.$teacherFullName.'</span>
                                </div>',
                'class'      => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->class_name.'</span>',
                'section'    => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->section_label.'</span>',
                'created_at' => '<span class="h6 mb-0 fw-medium text-gray-300">'.date("M d, Y", strtotime($row->created_at)).'</span>',
                'updated_at' => '<span class="h6 mb-0 fw-medium text-gray-300">'.date("M d, Y", strtotime($row->updated_at)).'</span>',
                'actions'    => '<div class="flex-align justify-content-center gap-10">
                                 <button data-id="'.$row->id.'" data-class-id="'.$row->class_id.'" data-section-id="'.$row->section_id.'" data-employee-id="'.$row->employee_id.'"
                                     class="edit-class-js bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"><i
                                         class="ph ph-pencil-simple"></i>Edit</button>
                                 <button data-id="'.$row->id.'"
                                     class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"><i
                                         class="ph ph-trash"></i>Delete</button>
                             </div>'
            ];
        }

        // Response for DataTables
        return service('response')->setJSON([
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
    }

    public function getAllEmployees () {
        $employeesModel = model('EmployeesModel');
        $employees = $employeesModel->where('deleted_at', null)->findAll();
        return $employees;
    }

}