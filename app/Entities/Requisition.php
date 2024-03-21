<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Requisition extends Entity
{
    protected $datamap = [];
    protected $dates   = ['CreatedAt', 'UpdatedAt', 'DeletedAt'];
    protected $casts   = [];
}
