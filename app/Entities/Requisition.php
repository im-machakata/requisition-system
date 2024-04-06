<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Requisition extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'CreatedAt',
        'UpdatedAt',
        'DeletedAt',
        'OutFrom',
        'OutTo'
    ];
    protected $casts   = [];

    public function setType(string $type)
    {
        $this->attributes['Type'] = $type;
        return $this;
    }
    public function setAmount(float $amount)
    {
        $this->attributes['Amount'] = $amount;
        return $this;
    }
    public function setAccountID(int $accountID)
    {
        $this->attributes['AccountID'] = $accountID;
        return $this;
    }
    public function setStatus(string $status)
    {
        $this->attributes['Status'] = $status;
        return $this;
    }
}
