<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Local/dev baseline data. Run after migrating:
 *
 *   php spark migrate
 *   php spark db:seed DatabaseSeeder
 *
 * Do not run this against production — DemoUsersSeeder creates fake
 * login accounts with a published password for local testing only.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(ToolsSeeder::class);
        $this->call(RolePermissionsSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(DemoUsersSeeder::class);
    }
}
