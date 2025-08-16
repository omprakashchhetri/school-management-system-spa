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
     * Get all subject allocations (not deleted).
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->subjectAllocationsModel->where('deleted_at', null)->findAll();
    }

    /**
     * Get one subject allocation by ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $allocation = $this->subjectAllocationsModel->where('deleted_at', null)->find($id);

        if (!$allocation) {
            return ['error' => 'Subject allocation not found'];
        }

        return $allocation;
    }

    /**
     * Add a new subject allocation.
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
     * Edit/Update subject allocation by ID.
     *
     * @param int $id
     * @return array
     */
    public function edit(int $id): array
    {
        $data = $this->request->getRawInput();

        if ($this->subjectAllocationsModel->update($id, $data)) {
            return ['message' => 'Subject allocation updated successfully'];
        }

        return ['error' => 'Failed to update subject allocation'];
    }

    /**
     * Delete subject allocation (soft delete by setting deleted_at).
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        $allocation = $this->subjectAllocationsModel->find($id);

        if (!$allocation) {
            return ['error' => 'Subject allocation not found'];
        }

        $this->subjectAllocationsModel->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);

        return ['message' => 'Subject allocation deleted successfully'];
    }
}
