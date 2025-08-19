<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;

class AdminRoleManagementController extends BaseController
{
    protected $paginationLimit, $roleModel, $rolePermissionsModel, $toolsModel;
    public function __construct(){
        $this->paginationLimit = getenv('PAGINATION_LIMIT');
        $this->roleModel = model('roleModel');
        $this->rolePermissionsModel = model('RolePermissionsModel');
        $this->toolsModel = model('ToolsModel');
    }

    public function getListOfRoles($offset=0) {
        $listOfRoles = $this->roleModel->where('deleted_at', null)->findAll($this->paginationLimit, $offset);
        return $listOfRoles;
    }

    /**
     * Get one role by ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array
    {
        $role = $this->roleModel->where('deleted_at', null)->find($id);

        if (!$role) {
            return ['error' => 'role not found'];
        }

        return $role;
    }

    /**
     * Add new role.
     *
     * @return array
     */
    public function add(): array
    {
        $data = $this->request->getPost();

        $roleId = $this->roleModel->insert($data); // this gives inserted role_id

        if ($roleId) {
            // Add Role Permissions
            $tools = $this->toolsModel->where('deleted_at', null)->findAll();
            foreach ($tools as $tool) {
                $toolId = $tool['id'];
                $payloadToCreateRolePermissions = [
                    'role_id'   => $roleId,
                    'tool_id'   => $toolId,
                    'can_view'  => 0,
                    'can_edit'  => 0,
                    'can_delete'=> 0,
                ];

                $this->rolePermissionsModel->insert($payloadToCreateRolePermissions);
            }

            return ['message' => 'role added successfully'];
        }

        return ['error' => 'Failed to add role'];
    }


    /**
     * Edit/Update role by ID.
     *
     * @param int $id
     * @return array
     */
    public function edit(int $id): array
    {
        $data = $this->request->getRawInput();

        if ($this->roleModel->update($id, $data)) {
            return ['message' => 'role updated successfully'];
        }

        return ['error' => 'Failed to update role'];
    }

    /**
     * Delete role (soft delete by setting deleted_at).
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        $role = $this->roleModel->find($id);

        if (!$role) {
            return ['error' => 'role not found'];
        }

        $this->roleModel->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);

        return ['message' => 'role deleted successfully'];
    }

    public function roleToolManagementDetails($roleId) {
        $roleToolDetails = $this->rolePermissionsModel->where('deleted_at', null)->where('role_id', $roleId)->findAll();
        $toolIds = array_column($roleToolDetails, 'tool_id');
        $toolDetails = $this->toolsModel->whereIn('id', $toolIds)->findAll();
        $toolIdToDetailsMap = array_column($toolDetails, null, 'id');
        foreach($roleToolDetails as &$roleToolRel) {
            $toolId = $roleToolRel['tool_id'];
            $roleToolRel['tool_details'] = $toolIdToDetailsMap[$toolId];
        }
        return $roleToolDetails;
    }

    public function editToolPermission() {
        $data = $this->request->getRawInput();

        if ($this->rolePermissionsModel->update($data['id'], $data)) {
            return ['message' => 'role updated successfully'];
        }

        return ['error' => 'Failed to update role'];
    }

}