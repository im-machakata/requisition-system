<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Requisition as ModelsRequisition;
use CodeIgniter\HTTP\ResponseInterface;

class Requisition extends BaseController
{

    public function pettyCashIndex()
    {
        $pettyCashRequisitions = model(ModelsRequisition::class);
        return view('forms/petty-cash', [
            ...self::$ADD_USER_CONFIG,
            'requisitions' => $pettyCashRequisitions
                ->where('Type', 'Petty_Cash')
                ->where('AccountID', $this->session->get('user')->ID)
                ->findAll()
        ]);
    }
}
