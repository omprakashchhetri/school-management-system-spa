<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: AttendanceRecordsModel
 * Auto-generated from SQL DDL
 */
class AttendanceRecordsModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'attendance_records';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;

    /**
     * IMPORTANT:
     * - Do NOT include `id`
     * - Do NOT include timestamp fields
     */
    protected $allowedFields = [
        'class_id',
        'section_id',
        'date',
        'taken_by',
        'taken_at'
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
