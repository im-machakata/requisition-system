<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    protected $datamap = [];
    protected $dates   = ['CreatedAt', 'UpdatedAt', 'DeletedAt'];
    protected $casts   = [];
}
