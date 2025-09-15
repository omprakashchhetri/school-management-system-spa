<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;

class EmployeeManagementController extends BaseController
{
    protected $employeeModel;
    public function __construct(){
        $this->employeeModel = model('EmployeesModel');

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


}