<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Fake, non-PII demo accounts for local development/testing only — never
 * run this against a production database. Passwords are hashed the same
 * way EmployeesController/StudentsController expect (password_hash()),
 * so these accounts can log in through the normal /api/login flow.
 *
 * Login credentials (all accounts): password "DemoPass!123"
 *   - admin@example.test      (Admin)
 *   - teacher@example.test    (Teacher)
 *   - accountant@example.test (Accountant)
 *   - student@example.test    (Student)
 */
class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $now      = date('Y-m-d H:i:s');
        $password = password_hash('DemoPass!123', PASSWORD_DEFAULT);

        $employees = [
            [
                'id'                            => 1,
                'firstname'                     => 'Demo',
                'lastname'                      => 'Admin',
                'middlename'                    => null,
                'related_class_teacher'         => null,
                'related_section_class_teacher' => null,
                'contact_number1'               => '9000000001',
                'contact_number2'                => null,
                'email1'                        => 'admin@example.test',
                'email2'                        => null,
                'password'                      => $password,
                'role_id'                       => 1,
                'street'                        => '',
                'city'                          => '',
                'pincode'                       => '',
                'district'                      => '',
                'country'                       => '',
                'profile_image'                 => '',
                'issued_jwt_token'              => '',
            ],
            [
                'id'                            => 2,
                'firstname'                     => 'Demo',
                'lastname'                      => 'Teacher',
                'middlename'                    => null,
                'related_class_teacher'         => 2,
                'related_section_class_teacher' => 1,
                'contact_number1'               => '9000000002',
                'contact_number2'                => null,
                'email1'                        => 'teacher@example.test',
                'email2'                        => null,
                'password'                      => $password,
                'role_id'                       => 2,
                'street'                        => '',
                'city'                          => '',
                'pincode'                       => '',
                'district'                      => '',
                'country'                       => '',
                'profile_image'                 => '',
                'issued_jwt_token'              => '',
            ],
            [
                'id'                            => 3,
                'firstname'                     => 'Demo',
                'lastname'                      => 'Accountant',
                'middlename'                    => null,
                'related_class_teacher'         => null,
                'related_section_class_teacher' => null,
                'contact_number1'               => '9000000003',
                'contact_number2'                => null,
                'email1'                        => 'accountant@example.test',
                'email2'                        => null,
                'password'                      => $password,
                'role_id'                       => 3,
                'street'                        => '',
                'city'                          => '',
                'pincode'                       => '',
                'district'                      => '',
                'country'                       => '',
                'profile_image'                 => '',
                'issued_jwt_token'              => '',
            ],
        ];

        foreach ($employees as &$employee) {
            $employee['created_at'] = $now;
            $employee['updated_at'] = $now;
        }
        unset($employee);

        $this->db->table('employees')->ignore(true)->insertBatch($employees);

        $students = [
            [
                'id'                 => 1,
                'firstname'          => 'Demo',
                'middlename'         => null,
                'lastname'           => 'Student',
                'roll_no'            => '1',
                'status'             => 'Active',
                'gender'             => 'Other',
                'admission_no'       => 'DEMO0001',
                'admission_date'     => date('Y-m-d'),
                'blood_group'        => null,
                'related_class'      => 2,
                'related_section'    => 1,
                'student_contact_no' => '9000000010',
                'student_email'      => 'student@example.test',
                'password'           => $password,
                'student_religion'   => null,
                'student_caste'      => null,
                'father_name'        => 'Demo Father',
                'mother_name'        => 'Demo Mother',
                'father_contact_no'  => '9000000011',
                'mother_contact_no'  => null,
                'profile_image'      => '',
                'street'             => '',
                'city'               => '',
                'pincode'            => '',
                'district'           => '',
                'country'            => '',
                'issued_jwt_token'   => '',
                'discount'           => 0.00,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
        ];

        $this->db->table('students')->ignore(true)->insertBatch($students);
    }
}
