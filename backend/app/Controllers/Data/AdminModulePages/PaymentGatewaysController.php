<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;

class PaymentGatewaysController extends BaseController
{
    protected $paymentGatewaysModel;

    public function __construct()
    {
        $this->paymentGatewaysModel = model('PaymentGatewaysModel');
    }

    /**
     * Get all payment gateways (not deleted).
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->paymentGatewaysModel
            ->where('deleted_at', null)
            ->findAll();
    }

    /**
     * Get one payment gateway by ID (from route param).
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $gateway = $this->paymentGatewaysModel
            ->where('deleted_at', null)
            ->find($id);

        if (!$gateway) {
            return ['error' => 'Payment gateway not found'];
        }

        return $gateway;
    }

    /**
     * Add a new payment gateway (POST).
     *
     * @return array
     */
    public function add(): array
    {
        $data = $this->request->getPost();

        if ($this->paymentGatewaysModel->insert($data)) {
            return ['message' => 'Payment gateway added successfully'];
        }

        return ['error' => 'Failed to add payment gateway'];
    }

    /**
     * Edit/Update payment gateway by ID (POST).
     *
     * @return array
     */
    public function edit(): array
    {
        $id   = $this->request->getPost('id');
        $data = $this->request->getPost();

        if (!$id) {
            return ['error' => 'Payment gateway ID is required'];
        }

        unset($data['id']); // prevent accidental overwrite

        if ($this->paymentGatewaysModel->update($id, $data)) {
            return ['message' => 'Payment gateway updated successfully'];
        }

        return ['error' => 'Failed to update payment gateway'];
    }

    /**
     * Delete payment gateway (soft delete by setting deleted_at) (POST).
     *
     * @return array
     */
    public function delete(): array
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return ['error' => 'Payment gateway ID is required'];
        }

        $gateway = $this->paymentGatewaysModel->find($id);

        if (!$gateway) {
            return ['error' => 'Payment gateway not found'];
        }

        $this->paymentGatewaysModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return ['message' => 'Payment gateway deleted successfully'];
    }
}
