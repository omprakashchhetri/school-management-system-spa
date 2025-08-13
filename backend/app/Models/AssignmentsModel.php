<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: AssignmentsModel
 * Auto-generated from SQL DDL
 */
class AssignmentsModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'assignments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
            'id',
            'related_class',
            'related_section',
            'related_subject',
            'related_teacher',
            'topic',
            'description',
            'upload_file',
            'deadline_date',
            'deadline_time',
            'created_at',
            'updated_at',
            'deleted_at',
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
