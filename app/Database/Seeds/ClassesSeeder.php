<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClassesSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $classes = [
            ['id' => 1, 'class_name' => 'nursery', 'label' => 'NURSERY', 'short_form' => 'NUR'],
            ['id' => 2, 'class_name' => 'one', 'label' => 'ONE', 'short_form' => '1'],
            ['id' => 3, 'class_name' => 'two', 'label' => 'TWO', 'short_form' => '2'],
            ['id' => 4, 'class_name' => 'three', 'label' => 'THREE', 'short_form' => '3'],
        ];

        foreach ($classes as &$class) {
            $class['created_at'] = $now;
            $class['updated_at'] = $now;
        }
        unset($class);

        $this->db->table('classes')->ignore(true)->insertBatch($classes);
    }
}
