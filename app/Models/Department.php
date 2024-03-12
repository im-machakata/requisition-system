<?php

namespace App\Models;

use App\Entities\Department as EntitiesDepartment;
use CodeIgniter\Model;

class Department extends Model
{
    protected $table            = 'departments';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesDepartment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Name',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
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
}
