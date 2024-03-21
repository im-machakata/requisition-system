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
    public function setUsername($value)
    {
        $this->attributes['Username'] = $value;
        return $this;
    }
    public function setPassword($value)
    {
        $this->attributes['Password'] = $value;
        return $this;
    }
}
