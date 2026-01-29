<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: StudentsModel
 * Auto-generated from SQL DDL
 */
class StudentsModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
            'id',
            'firstname',
            'middlename',
            'lastname',
            'roll_no',
            'blood_group',
            'related_class',
            'related_section',
            'student_contact_no',
            'student_email',
            'password',
            'student_religion',
            'student_caste',
            'father_name',
            'mother_name',
            'father_contact_no',
            'mother_contact_no',
            'profile_image',
            'street',
            'city',
            'pincode',
            'district',
            'country',
            'created_at',
            'updated_at',
            'deleted_at',
            'issued_jwt_token',
        ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

}