<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;

class SubjectAllocationsController extends BaseController
{
    protected $subjectAllocationsModel;

    public function __construct()
    {
        $this->subjectAllocationsModel = model('SubjectAllocationsModel');
    }

    /**
     * Get all subject allocations with class, section, teacher, and subject details (not deleted).
     *
     * @return array
     */
    public function getSubjectAllocationList($postData)
    {
        $draw   = intval($postData['draw']);
        $start  = intval($postData['start']);
        $length = intval($postData['length']);
        $searchValue = $postData['search']['value'] ?? '';

        $builder = $this->subjectAllocationsModel->builder()
            ->select('
                subject_allocations.id,
                subject_allocations.class,
                subject_allocations.section,
                subject_allocations.teacher,
                subject_allocations.subject,
                c.class_name,
                s.section_label,
                CONCAT(e.firstname, " ", e.lastname) as teacher_name,
                subj.subject_name,
                subject_allocations.created_at
            ')
            ->join('classes c', 'c.id = subject_allocations.class', 'left')
            ->join('sections s', 's.id = subject_allocations.section', 'left')
            ->join('employees e', 'e.id = subject_allocations.teacher', 'left')
            ->join('subjects subj', 'subj.id = subject_allocations.subject', 'left')
            ->where('subject_allocations.deleted_at', null);

        // Searching
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('c.class_name', $searchValue)
                ->orLike('s.section_label', $searchValue)
                ->orLike('e.firstname', $searchValue)
                ->orLike('e.lastname', $searchValue)
                ->orLike('subj.subject_name', $searchValue)
                ->groupEnd();
        }

        // Ordering
        if (isset($postData['order'])) {
            $colIndex = $postData['order'][0]['column'];
            $colDir   = $postData['order'][0]['dir'];
            $columns  = [
                'subject_allocations.id',
                'c.class_name',
                's.section_label',
                'teacher_name',
                'subj.subject_name',
                'subject_allocations.created_at'
            ];
            if (isset($columns[$colIndex])) {
                $builder->orderBy($columns[$colIndex], $colDir);
            }
        } else {
            $builder->orderBy('subject_allocations.id', 'DESC');
        }

        // Pagination
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $query   = $builder->get();
        $records = $query->getResult();

        // For DataTables
        $totalFiltered = $builder->countAllResults(false);
        $totalRecords  = $this->subjectAllocationsModel->builder()
                            ->where('deleted_at', null)
                            ->countAllResults();

        $data = [];
        foreach ($records as $row) {
            $data[] = [
                'checkbox'   => '<input type="checkbox" value="'.$row->id.'" class="form-check-input">',
                'class'      => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->class_name.'</span>',
                'section'    => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->section_label.'</span>',
                'teacher'    => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->teacher_name.'</span>',
                'subject'    => '<span class="h6 mb-0 fw-medium text-gray-300">'.$row->subject_name.'</span>',
                'created_at' => '<span class="h6 mb-0 fw-medium text-gray-300">'.date("M d, Y", strtotime($row->created_at)).'</span>',
                'actions'    => '<button 
                                    data-id="'.$row->id.'" 
                                    data-class="'.$row->class.'" 
                                    data-section="'.$row->section.'" 
                                    data-teacher="'.$row->teacher.'" 
                                    data-subject="'.$row->subject.'" 
                                    class="edit-subject-allocation-js bg-warning-50 text-warning-600 py-2 px-14 rounded-pill">
                                        Edit
                                    </button>
                                    <button data-id="'.$row->id.'" 
                                    class="delete-subject-allocation-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill">
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





    /**
     * Get one subject allocation by ID with class, section, teacher, and subject details.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $record = $this->subjectAllocationsModel
            ->select('sa.id, c.class_name, s.section_label, CONCAT(t.firstname, " ", t.lastname) as teacher_name, sub.subject_name, sa.created_at, sa.updated_at')
            ->from('subject_allocations sa')
            ->join('classes c', 'c.id = sa.class')
            ->join('sections s', 's.id = sa.section')
            ->join('employees t', 't.id = sa.teacher')
            ->join('subjects sub', 'sub.id = sa.subject')
            ->where('sa.deleted_at', null)
            ->where('sa.id', $id)
            ->first();

        if (!$record) {
            return ['error' => 'Subject allocation not found'];
        }

        return $record;
    }

    /**
     * Add a new subject allocation (POST).
     *
     * @return array
     */
    public function add($data): array
    {
        if ($this->subjectAllocationsModel->insert($data)) {
            return ['message' => 'Subject allocation added successfully'];
        }

        return ['error' => 'Failed to add subject allocation'];
    }

    /**
     * Edit/Update subject allocation by ID (POST).
     *
     * @return array
     */
    public function edit($data): array
    {

        $id = $data['id'] ?? null;
        if (!$id) return ['error' => 'Subject allocation ID is required'];

        unset($data['id']); // avoid overwriting PK
        if ($this->subjectAllocationsModel->update($id, $data)) {
            return ['message' => 'Employee updated successfully'];
        }
        return ['error' => 'Failed to update Subject allocation'];
    }

    /**
     * Delete subject allocation (soft delete by setting deleted_at) (POST).
     *
     * @return array
     */
    public function delete($id): array
    {

        if (!$id) return ['error' => 'Subject allocation ID required'];

        $record = $this->subjectAllocationsModel->find($id);
        if (!$record) return ['error' => 'Subject allocation not found'];

        $this->subjectAllocationsModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Subject allocation deleted successfully'];
    }
}
