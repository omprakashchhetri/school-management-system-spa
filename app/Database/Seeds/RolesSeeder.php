<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Baseline roles. IDs are fixed so RolePermissionsSeeder and
 * DemoUsersSeeder can reference them directly.
 */
class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $roles = [
            ['id' => 1, 'role_name' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'role_name' => 'Teacher', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'role_name' => 'Accountant', 'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('roles')->ignore(true)->insertBatch($roles);
    }
}
