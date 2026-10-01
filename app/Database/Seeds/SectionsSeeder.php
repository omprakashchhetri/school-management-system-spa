<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SectionsSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $sections = [
            ['id' => 1, 'section_label' => 'A'],
            ['id' => 2, 'section_label' => 'B'],
        ];

        foreach ($sections as &$section) {
            $section['created_at'] = $now;
            $section['updated_at'] = $now;
        }
        unset($section);

        $this->db->table('sections')->ignore(true)->insertBatch($sections);
    }
}
