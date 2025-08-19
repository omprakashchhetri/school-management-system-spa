<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;

class SectionsController extends BaseController
{
    protected $sectionsModel;

    public function __construct()
    {
        $this->sectionsModel = model('SectionsModel');
    }

    /**
     * Get all sections (not deleted).
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->sectionsModel
            ->where('deleted_at', null)
            ->findAll();
    }

    /**
     * Get one section by ID (from route param).
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $section = $this->sectionsModel
            ->where('deleted_at', null)
            ->find($id);

        if (!$section) {
            return ['error' => 'Section not found'];
        }

        return $section;
    }

    /**
     * Add new section (POST).
     *
     * @return array
     */
    public function add(): array
    {
        $data = $this->request->getPost();

        if ($this->sectionsModel->insert($data)) {
            return ['message' => 'Section added successfully'];
        }

        return ['error' => 'Failed to add section'];
    }

    /**
     * Edit/Update section by ID (POST).
     *
     * @return array
     */
    public function edit(): array
    {
        $id   = $this->request->getPost('id');
        $data = $this->request->getPost();

        if (!$id) {
            return ['error' => 'Section ID is required'];
        }

        unset($data['id']); // prevent accidental overwrite

        if ($this->sectionsModel->update($id, $data)) {
            return ['message' => 'Section updated successfully'];
        }

        return ['error' => 'Failed to update section'];
    }

    /**
     * Delete section (soft delete by setting deleted_at) (POST).
     *
     * @return array
     */
    public function delete(): array
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return ['error' => 'Section ID is required'];
        }

        $section = $this->sectionsModel->find($id);

        if (!$section) {
            return ['error' => 'Section not found'];
        }

        $this->sectionsModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Section deleted successfully'];
    }
}
