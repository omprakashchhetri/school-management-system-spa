<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Admin module tiles, matching the base_route values Routes.php actually
 * serves. IDs are fixed so RolePermissionsSeeder can reference them.
 */
class ToolsSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $tools = [
            ['id' => 1, 'tool_name' => 'Admin Data Management', 'is_active' => 1, 'base_route' => 'admin/role-list', 'color' => 'text-primary', 'icon' => 'ph-database'],
            ['id' => 2, 'tool_name' => 'Student Information System', 'is_active' => 1, 'base_route' => 'student/list', 'color' => 'text-success', 'icon' => 'ph-student'],
            ['id' => 3, 'tool_name' => 'Employee Information Management', 'is_active' => 1, 'base_route' => 'employee/list', 'color' => 'text-info', 'icon' => 'ph-users'],
            ['id' => 4, 'tool_name' => 'Attendance Management', 'is_active' => 1, 'base_route' => 'attendance/mark-attendance', 'color' => 'text-warning', 'icon' => 'ph-calendar-check'],
            ['id' => 5, 'tool_name' => 'Academic & Lesson Planning', 'is_active' => 1, 'base_route' => 'academic/syllabus-list', 'color' => 'text-purple', 'icon' => 'ph-book-open'],
            ['id' => 6, 'tool_name' => 'Schedule Management', 'is_active' => 0, 'base_route' => '', 'color' => '', 'icon' => ''],
            ['id' => 7, 'tool_name' => 'Assignment, Homework & Notes', 'is_active' => 0, 'base_route' => '', 'color' => '', 'icon' => ''],
            ['id' => 8, 'tool_name' => 'Examination & Test Management', 'is_active' => 1, 'base_route' => 'examination/create-routine', 'color' => 'text-danger', 'icon' => 'ph-clipboard-text'],
            ['id' => 9, 'tool_name' => 'Fee Management', 'is_active' => 1, 'base_route' => 'fees/slab-list', 'color' => 'text-secondary', 'icon' => 'ph-wallet'],
            ['id' => 10, 'tool_name' => 'Admission Management', 'is_active' => 1, 'base_route' => 'admission-create', 'color' => 'text-success', 'icon' => 'ph-user-plus'],
            ['id' => 11, 'tool_name' => 'Notifications', 'is_active' => 0, 'base_route' => '', 'color' => '', 'icon' => ''],
            ['id' => 12, 'tool_name' => 'Transport Management', 'is_active' => 0, 'base_route' => '', 'color' => '', 'icon' => ''],
        ];

        foreach ($tools as &$tool) {
            $tool['created_at'] = $now;
            $tool['updated_at'] = $now;
        }
        unset($tool);

        $this->db->table('tools')->ignore(true)->insertBatch($tools);
    }
}
