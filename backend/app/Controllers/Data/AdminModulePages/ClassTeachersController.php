<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;

class ClassTeachersController extends BaseController
{
    protected $classTeachersModel;

    public function __construct()
    {
        $this->classTeachersModel = model('ClassTeachersModel');
    }

    /**
     * Get all class-teacher mappings with class, section, and teacher details (not deleted).
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->classTeachersModel
            ->select('ct.id, c.class_name, s.section_label, t.firstname, t.lastname, ct.created_at, ct.updated_at')
            ->from('class_teachers ct')
            ->join('classes c', 'c.id = ct.class')
            ->join('sections s', 's.id = ct.section')
            ->join('employees t', 't.id = ct.teacher')
            ->where('ct.deleted_at', null)
            ->findAll();
    }

    /**
     * Get one class-teacher mapping by ID with class, section, and teacher details.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $record = $this->classTeachersModel
            ->select('ct.id, c.class_name, s.section_label, t.firstname, t.lastname, ct.created_at, ct.updated_at')
            ->from('class_teachers ct')
            ->join('classes c', 'c.id = ct.class')
            ->join('sections s', 's.id = ct.section')
            ->join('employees t', 't.id = ct.teacher')
            ->where('ct.deleted_at', null)
            ->where('ct.id', $id)
            ->first();

        if (!$record) {
            return ['error' => 'Class-Teacher record not found'];
        }

        return $record;
    }


    /**
     * Add new class-teacher mapping (POST).
     *
     * @return array
     */
    public function add(): array
    {
        $data = $this->request->getPost();

        if ($this->classTeachersModel->insert($data)) {
            return ['message' => 'Class-Teacher mapping added successfully'];
        }

        return ['error' => 'Failed to add record'];
    }

    /**
     * Edit/Update class-teacher mapping by ID (POST).
     *
     * @return array
     */
    public function edit(): array
    {
        $id   = $this->request->getPost('id');
        $data = $this->request->getPost();

        if (!$id) {
            return ['error' => 'Record ID is required'];
        }

        unset($data['id']); // prevent accidental overwrite

        if ($this->classTeachersModel->update($id, $data)) {
            return ['message' => 'Record updated successfully'];
        }

        return ['error' => 'Failed to update record'];
    }

    /**
     * Delete record (soft delete by setting deleted_at) (POST).
     *
     * @return array
     */
    public function delete(): array
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return ['error' => 'Record ID is required'];
        }

        $record = $this->classTeachersModel->find($id);

        if (!$record) {
            return ['error' => 'Record not found'];
        }

        $this->classTeachersModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Record deleted successfully'];
    }
}
