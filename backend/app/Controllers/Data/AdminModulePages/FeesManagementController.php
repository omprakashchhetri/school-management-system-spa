<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Models\FeesSlabsModel;

class FeesManagementController extends BaseController
{
    protected $feesSlabModel;

    public function __construct()
    {
        $this->feesSlabModel = new FeesSlabsModel();
    }

    public function getFeesSlabList(array $postData)
    {
        $draw = intval($postData['draw'] ?? 1);
        $start = intval($postData['start'] ?? 0);
        $length = intval($postData['length'] ?? 10);
        $searchValue = $postData['search']['value'] ?? '';

        $builder = $this->feesSlabModel->builder()
            ->select('fees_slabs.id, fees_slabs.total_amount, c.class_name, fees_slabs.class')
            ->join('classes c', 'c.id = fees_slabs.class', 'left')
            ->where('fees_slabs.deleted_at', null);

        /* ---------- Search ---------- */
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('c.class_name', $searchValue)
                ->orLike('fees_slabs.total_amount', $searchValue)
                ->groupEnd();
        }

        /* ---------- Order ---------- */
        if (!empty($postData['order'])) {
            $columns = [
                'fees_slabs.id',
                'c.class_name',
                'fees_slabs.total_amount'
            ];

            $colIndex = $postData['order'][0]['column'];
            $dir = $postData['order'][0]['dir'];

            if (isset($columns[$colIndex])) {
                $builder->orderBy($columns[$colIndex], $dir);
            }
        } else {
            $builder->orderBy('fees_slabs.id', 'DESC');
        }

        /* ---------- Pagination ---------- */
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $records = $builder->get()->getResultArray();

        $totalFiltered = $builder->countAllResults(false);
        $totalRecords = $this->feesSlabModel
            ->where('deleted_at', null)
            ->countAllResults();

        /* ---------- Format Data ---------- */
        $data = [];

        foreach ($records as $row) {
            $data[] = [
                'checkbox' => '<input type="checkbox" class="form-check-input" value="' . $row['id'] . '">',
                'class_name' => '<span class="fw-medium text-gray-700">' . $row['class_name'] . '</span>',
                'total_amount' => '<span class="fw-medium text-gray-700">₹ ' . $row['total_amount'] . '</span>',
                'actions' => '
                <button
                    class="edit-fees-slab-js bg-warning-50 text-warning-600 py-2 px-14 rounded-pill"
                    data-id="' . $row['id'] . '"
                    data-class="' . $row['class'] . '"
                    data-amount="' . $row['total_amount'] . '">
                    Edit
                </button>
                <button
                    class="delete-fees-slab-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill"
                    data-id="' . $row['id'] . '">
                    Delete
                </button>
            '
            ];
        }

        return service('response')->setJSON([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data
        ]);
    }

    public function addFeesSlab(array $data): array
    {
        if (empty($data['class']) || empty($data['total_amount'])) {
            return ['error' => 'Class and Total Amount are required'];
        }

        // Prevent duplicate slab per class
        $exists = $this->feesSlabModel
            ->where('class', $data['class'])
            ->where('deleted_at', null)
            ->first();

        if ($exists) {
            return ['error' => 'Fees slab already exists for this class'];
        }

        $this->feesSlabModel->insert([
            'class' => $data['class'],
            'total_amount' => $data['total_amount']
        ]);

        return ['message' => 'Fees slab added successfully'];
    }

    public function editFeesSlab(array $data): array
    {
        $id = $data['id'] ?? null;

        if (!$id) {
            return ['error' => 'Fees slab ID required'];
        }

        $record = $this->feesSlabModel->find($id);
        if (!$record) {
            return ['error' => 'Fees slab not found'];
        }

        // Prevent duplicate class slab (excluding self)
        $exists = $this->feesSlabModel
            ->where('class', $data['class'])
            ->where('id !=', $id)
            ->where('deleted_at', null)
            ->first();

        if ($exists) {
            return ['error' => 'Another fees slab already exists for this class'];
        }

        $this->feesSlabModel->update($id, [
            'class' => $data['class'],
            'total_amount' => $data['total_amount']
        ]);

        return ['message' => 'Fees slab updated successfully'];
    }

    public function deleteFeesSlab(int $id): array
    {
        if (!$id) {
            return ['error' => 'Fees slab ID required'];
        }

        $record = $this->feesSlabModel->find($id);
        if (!$record) {
            return ['error' => 'Fees slab not found'];
        }

        $this->feesSlabModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Fees slab deleted successfully'];
    }


}
