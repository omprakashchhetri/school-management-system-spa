<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;

class AdminRoleManagementController extends BaseController
{
    protected $paginationLimit, $roleModel, $rolePermissionsModel, $toolsModel;
    public function __construct(){
        $this->paginationLimit = getenv('PAGINATION_LIMIT');
        $this->roleModel = model('RolesModel');
        $this->rolePermissionsModel = model('RolePermissionsModel');
        $this->toolsModel = model('ToolsModel');
    }

    public function getListOfRoles($sortOption = "DESC") {
        $listOfRoles = $this->roleModel
            ->where('deleted_at', null)
            ->orderBy('created_at', $sortOption) // or replace 'id' with the correct column to sort by
            ->findAll();
    
        return $listOfRoles;
    }
    
    /**
     * Get one role by ID.
     *
     * @param int $id
     * @return array
     */
    public function getOne(int $roleId): ?array
    {
        // Get one role row
        $role = $this->roleModel
            ->where('deleted_at', null)
            ->find($roleId);

        if (!$role) {
            return null; // role not found
        }

        // Get the role-tool relations for this role
        $roleToolDetails = $this->rolePermissionsModel
            ->where('deleted_at', null)
            ->where('role_id', $roleId)
            ->findAll();

        if (!empty($roleToolDetails)) {
            $toolIds = array_column($roleToolDetails, 'tool_id');
            $toolDetails = $this->toolsModel->whereIn('id', $toolIds)->findAll();
            $toolIdToDetailsMap = array_column($toolDetails, null, 'id');

            // attach tool details to relations
            foreach ($roleToolDetails as &$rel) {
                $toolId = $rel['tool_id'];
                $rel['tool_details'] = $toolIdToDetailsMap[$toolId] ?? null;
            }
        }

        // attach relations to role
        $role['tools'] = $roleToolDetails;

        return $role;
    }


    /**
     * Add new role.
     *
     * @return array
     */
    public function add($data = []): array
    {

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
    public function edit($data): array {
        $roleId = $data['id'];
        unset($data['id']);
    
        // Extract tool permissions if present
        $toolPermissions = $data['toolPermission'] ?? [];
        unset($data['toolPermission']);

        $roleDataToUpdate = [
            'role_name' => $data['roleName'],
        ];
    
        // Update role info
        $updated = $this->roleModel->update($roleId, $roleDataToUpdate);
    
        if ($updated) {
            // Update role permissions
            if (!empty($toolPermissions)) {
                foreach ($toolPermissions as $toolId => $permissions) {
                    // Check if a record already exists for this role-tool
                    $existing = $this->rolePermissionsModel
                        ->where('role_id', $roleId)
                        ->where('id', $toolId)
                        ->first();
    
                    $payload = [
                        'can_view'   => $permissions['can_view'] ?? 0,
                        'can_edit'   => $permissions['can_edit'] ?? 0,
                        'can_delete' => $permissions['can_delete'] ?? 0,
                    ];
    
                    if ($existing) {
                        // Update existing permission row
                        $this->rolePermissionsModel->update($existing['id'], $payload);
                    } else {
                        // Insert new permission row if not exist
                        $payload['role_id'] = $roleId;
                        $payload['tool_id'] = $toolId;
                        $this->rolePermissionsModel->insert($payload);
                    }
                }
            }
    
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