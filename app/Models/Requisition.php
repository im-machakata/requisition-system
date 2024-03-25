<?php

namespace App\Models;

use App\Entities\Requisition as EntitiesRequisition;
use CodeIgniter\Model;

class Requisition extends Model
{
    const PETTY_CASH = 'Petty_Cash';
    const ADVANCED_SALARY = 'Advanced_Salary';
    const TRAVEL_AND_SUBSISTENCIES = 'Travel_Subsistencies';
    protected $table            = 'requisitions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesRequisition::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Amount',
        'Reason',
        'OutTo',
        'OutFrom',
        'AccountID',
        'Status',
        'Type'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'int';
    protected $createdField  = 'CreatedAt';
    protected $updatedField  = 'UpdatedAt';
    protected $deletedField  = 'DeletedAt';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function filterByUser(int $userID)
    {
        return $this->where('AccountID', $userID);
    }
    public function filterType(string $requisitionType)
    {
        return $this->where('Type', $requisitionType);
    }
}
