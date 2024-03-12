<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Department extends Entity
{
    protected $datamap = [];
    protected $dates   = ['CreatedAt', 'UpdatedAt', 'DeletedAt'];
    protected $casts   = [
        'Name' => 'string',
    ];
}
