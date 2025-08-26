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
     * Add new class (POST).
     *
     * @return array
     */
    public function add($data): array
    {
        // $data = $this->request->getPost([
        //     'class_name',
        //     'label',
        //     'short_form'
        // ]);

        if ($this->classesModel->insert($data)) {
            return ['message' => 'Class added successfully'];
        }

        return ['error' => 'Failed to add class'];
    }

    /**
     * Edit/Update class by ID (POST).
     *
     * @return array
     */
    public function edit(): array
    {
        $id   = $this->request->getPost('id');
        $data = $this->request->getPost([
            'class_name',
            'label',
            'short_form'
        ]);

        if (!$id) {
            return ['error' => 'Record ID is required'];
        }

        if ($this->classesModel->update($id, $data)) {
            return ['message' => 'Class updated successfully'];
        }

        return ['error' => 'Failed to update class'];
    }

    /**
     * Soft Delete class by ID (POST).
     *
     * @return array
     */
    public function delete(): array
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return ['error' => 'Record ID is required'];
        }

        $record = $this->classesModel->find($id);

        if (!$record) {
            return ['error' => 'Record not found'];
        }

        $this->classesModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Class deleted successfully'];
    }
}