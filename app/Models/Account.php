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

    public function filterByUser(int|string $userID)
    {
        if (is_string($userID)) {
            return $this->where('Username', $userID);
        }
        return $this->where('ID', $userID);
    }
    /**
     * Returns an array of employees and their departments 6 at a time
     *
     * @return array|null
     */
    public function getUsers(bool $paginate = true)
    {
        $this->select('Username, emp.Name, emp.Surname, CONCAT(emp.Name," ",Surname) AS Names, dep.Name AS DepartmentName, DepartmentID');
        $this->join('employees as emp', 'AccountID =  accounts.ID')
            ->join('departments as dep', 'DepartmentID = dep.ID');
        if ($paginate) return $this->paginate(6);
        return $this->findAll();
    }
}
