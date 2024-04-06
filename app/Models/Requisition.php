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

    public function filterByUser(int|string $userID)
    {
        if (is_string($userID)) {
            $userID = model(Account::class)
                ->where('Username', $userID)
                ->first()
                ->ID;
        }
        return $this->where('AccountID', $userID);
    }
    public function filterType(string $requisitionType)
    {
        return $this->where('Type', $requisitionType);
    }
    public function getPettyCash(?int $userID)
    {
        // if user id is present, filter by user
        if (!is_null($userID)) {
            $this->filterByUser($userID);
        }

        return $this
            ->filterType(self::PETTY_CASH)
            ->orderBy('CreatedAt')
            ->paginate(3);
    }
    public function getAdvancedSalaries(?int $userID)
    {
        // if user id is present, filter by user
        if (!is_null($userID)) {
            $this->filterByUser($userID);
        }

        return $this
            ->filterType(self::ADVANCED_SALARY)
            ->orderBy('CreatedAt')
            ->paginate(3);
    }
    public function getTravelAndSubsistencies(?int $userID)
    {
        // if user id is present, filter by user
        if (!is_null($userID)) {
            $this->filterByUser($userID);
        }

        return $this
            ->filterType(self::TRAVEL_AND_SUBSISTENCIES)
            ->orderBy('CreatedAt')
            ->paginate(3);
    }
    public function getRequisitions()
    {
        $this->orderBy('requisitions.CreatedAt', 'DESC');
        return $this;
    }
    public function getOwners()
    {
        return $this->join('employees as emp', 'emp.AccountID = requisitions.AccountID');
    }
}
