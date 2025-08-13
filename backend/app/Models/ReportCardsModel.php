<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: ReportCardsModel
 * Auto-generated from SQL DDL
 */
class ReportCardsModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'report_cards';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
            'id',
            'related_student',
            'related_exam',
            'average',
            'percentage',
            'total',
            'ranking',
            'outcome',
            'total_possible_marks',
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
