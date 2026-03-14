<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: TeacherAttendanceModel
 * Auto-generated from SQL DDL
 */
class TeacherAttendanceModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'teacher_attendance';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
            'id',
            'teacher_id',
            'status',
            'punch_in',
            'punch_out',
            'date',
            'attendance_type',
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