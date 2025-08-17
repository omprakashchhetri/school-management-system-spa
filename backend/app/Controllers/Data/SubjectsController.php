<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;

class SubjectsController extends BaseController
{
    protected $subjectsModel;

    public function __construct()
    {
        $this->subjectsModel = model('SubjectsModel');
    }

    /**
     * Get all subjects (not deleted).
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->subjectsModel->where('deleted_at', null)->findAll();
    }

    /**
     * Get one subject by ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $subject = $this->subjectsModel->where('deleted_at', null)->find($id);

        if (!$subject) {
            return ['error' => 'Subject not found'];
        }

        return $subject;
    }

    /**
     * Add a new subject.
     *
     * @return array
     */
    public function add(): array
    {
        $data = $this->request->getPost();

        if ($this->subjectsModel->insert($data)) {
            return ['message' => 'Subject added successfully'];
        }

        return ['error' => 'Failed to add subject'];
    }

    /**
     * Edit/Update subject by ID.
     *
     * @param int $id
     * @return array
     */
    public function edit(int $id): array
    {
        $data = $this->request->getRawInput();

        if ($this->subjectsModel->update($id, $data)) {
            return ['message' => 'Subject updated successfully'];
        }

        return ['error' => 'Failed to update subject'];
    }

    /**
     * Delete subject (soft delete by setting deleted_at).
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        $subject = $this->subjectsModel->find($id);

        if (!$subject) {
            return ['error' => 'Subject not found'];
        }

        $this->subjectsModel->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);

        return ['message' => 'Subject deleted successfully'];
    }
}
