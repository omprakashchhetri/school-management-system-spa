<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Models\ClassesModel;

class ClassesController extends BaseController
{
    protected $classesModel;

    public function __construct()
    {
        $this->classesModel = new ClassesModel();
    }

    /**
     * Get all classes (not deleted).
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->classesModel
            ->where('deleted_at', null)
            ->orderBy('class_name', 'ASC')
            ->findAll();
    }

    /**
     * Get one class by ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $record = $this->classesModel
            ->where('deleted_at', null)
            ->find($id);

        if (!$record) {
            return ['error' => 'Class record not found'];
        }

        return $record;
    }

    /**
     *
     * @return array
     */
    public function add($data = []): array
    {
        if ($this->classesModel->insert($data)) {
            return ['message' => 'Class added successfully'];
        }

        return ['error' => 'Failed to add class'];
    }

   /**
     *
     * @return array
     */
    public function edit($data): array
    {
        $id   = $data['id'];

        if (!$id) {
            return ['error' => 'Class ID is required'];
        }

        unset($data['id']); // prevent accidental overwrite

        if ($this->classesModel->update($id, $data)) {
            return ['message' => 'Class updated successfully'];
        }

        return ['error' => 'Failed to update Class'];
    }

    /**
     * Delete Class (soft delete by setting deleted_at)
     *
     * @return array
     */
    public function delete($id): array
    {

        if (!$id) {
            return ['error' => 'Class ID is required'];
        }

        $Class = $this->classesModel->find($id);

        if (!$Class) {
            return ['error' => 'Class not found'];
        }

        $this->classesModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Class deleted successfully'];
    }
}