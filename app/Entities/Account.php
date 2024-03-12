<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Account extends Entity
{
    protected $datamap = [];
    protected $dates   = ['CreatedAt', 'UpdatedAt', 'DeletedAt'];
    protected $casts   = [
        'Username',
        'Password'
    ];
}
