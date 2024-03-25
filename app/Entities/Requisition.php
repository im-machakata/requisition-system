<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Requisition extends Entity
{
    protected $datamap = [];
    protected $dates   = ['CreatedAt', 'UpdatedAt', 'DeletedAt'];
    protected $casts   = [];
    public function setType(string $type)
    {
        $this->__set('Type', $type);
        return $this;
    }
    public function setAmount(float $amount)
    {
        $this->__set('Amount', $amount);
        return $this;
    }
    public function setAccountID(int $accountID)
    {
        $this->__set('AccountID', $accountID);
        return $this;
    }
    public function setStatus(string $status)
    {
        $this->__set('Status', $status);
        return $this;
    }
}
