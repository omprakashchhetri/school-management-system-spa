<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $subjects = [
            ['id' => 1, 'subject_name' => 'English'],
            ['id' => 2, 'subject_name' => 'Mathematics'],
            ['id' => 3, 'subject_name' => 'Science'],
            ['id' => 4, 'subject_name' => 'Social Science'],
        ];

        foreach ($subjects as &$subject) {
            $subject['created_at'] = $now;
            $subject['updated_at'] = $now;
        }
        unset($subject);

        $this->db->table('subjects')->ignore(true)->insertBatch($subjects);
    }
}
