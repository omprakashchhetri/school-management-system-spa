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
        return $this->sectionsModel->where('deleted_at', null)->findAll();
    }

    /**
     * Get one section by ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $section = $this->sectionsModel->where('deleted_at', null)->find($id);

        if (!$section) {
            return ['error' => 'Section not found'];
        }

        return $section;
    }

    /**
     * Add new section.
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
     * Edit/Update section by ID.
     *
     * @param int $id
     * @return array
     */
    public function edit(int $id): array
    {
        $data = $this->request->getRawInput();

        if ($this->sectionsModel->update($id, $data)) {
            return ['message' => 'Section updated successfully'];
        }

        return ['error' => 'Failed to update section'];
    }

    /**
     * Delete section (soft delete by setting deleted_at).
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        $section = $this->sectionsModel->find($id);

        if (!$section) {
            return ['error' => 'Section not found'];
        }

        $this->sectionsModel->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);

        return ['message' => 'Section deleted successfully'];
    }
}
