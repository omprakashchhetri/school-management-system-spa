<?php
namespace App\Models;

use CodeIgniter\Model;

class EmployeesModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
            'id',
            'firstname',
            'lastname',
            'middlename',
            'related_class_teacher',
            'related_section_class_teacher',
            'contact_number1',
            'contact_number2',
            'email1',
            'email2',
            'role_id',
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
