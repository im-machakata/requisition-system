<?php

namespace App\Models;

use App\Entities\Account as EntitiesAccount;
use CodeIgniter\Model;

class Account extends Model
{
    protected $table            = 'accounts';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesAccount::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Username',
        'Password',
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

    /**
     * Returns an array of employees and their departments 6 at a time
     *
     * @return array|null
     */
    public function getUsers()
    {
        return $this->join('employees', 'AccountID =  accounts.ID')
            ->join('departments', 'DepartmentID = departments.ID')
            ->paginate(6);
    }
}
