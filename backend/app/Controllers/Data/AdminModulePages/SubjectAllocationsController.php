<?php

namespace App\Controllers\Data;

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
    public function getAll(): array
    {
        return $this->subjectAllocationsModel
            ->select('sa.id, c.class_name, s.section_label, CONCAT(t.firstname, " ", t.lastname) as teacher_name, sub.subject_name, sa.created_at, sa.updated_at')
            ->from('subject_allocations sa')
            ->join('classes c', 'c.id = sa.class')
            ->join('sections s', 's.id = sa.section')
            ->join('employees t', 't.id = sa.teacher')
            ->join('subjects sub', 'sub.id = sa.subject')
            ->where('sa.deleted_at', null)
            ->findAll();
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
    public function add(): array
    {
        $data = $this->request->getPost();

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
    public function edit(): array
    {
        $id   = $this->request->getPost('id');
        $data = $this->request->getPost();

        if (!$id) {
            return ['error' => 'Subject allocation ID is required'];
        }

        unset($data['id']); // avoid overwriting ID

        if ($this->subjectAllocationsModel->update($id, $data)) {
            return ['message' => 'Subject allocation updated successfully'];
        }

        return ['error' => 'Failed to update subject allocation'];
    }

    /**
     * Delete subject allocation (soft delete by setting deleted_at) (POST).
     *
     * @return array
     */
    public function delete(): array
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return ['error' => 'Subject allocation ID is required'];
        }

        $allocation = $this->subjectAllocationsModel->find($id);

        if (!$allocation) {
            return ['error' => 'Subject allocation not found'];
        }

        $this->subjectAllocationsModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Subject allocation deleted successfully'];
    }
}
