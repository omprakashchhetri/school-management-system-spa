<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Grants Admin full access to every tool, and gives Teacher/Accountant a
 * narrower slice so the "logged in as a non-admin" path is testable too.
 * Requires RolesSeeder and ToolsSeeder to have run first.
 */
class RolePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $now  = date('Y-m-d H:i:s');
        $rows = [];

        // Admin (role_id 1): full CRUD on every tool.
        for ($toolId = 1; $toolId <= 12; $toolId++) {
            $rows[] = [
                'role_id'    => 1,
                'tool_id'    => $toolId,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Teacher (role_id 2): view/edit on attendance, academics, exams.
        foreach ([4, 5, 8] as $toolId) {
            $rows[] = [
                'role_id'    => 2,
                'tool_id'    => $toolId,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Accountant (role_id 3): view/edit on fee management only.
        $rows[] = [
            'role_id'    => 3,
            'tool_id'    => 9,
            'can_view'   => 1,
            'can_edit'   => 1,
            'can_delete' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $this->db->table('role_permissions')->insertBatch($rows);
    }
}
