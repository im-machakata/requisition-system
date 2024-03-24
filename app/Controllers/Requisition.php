<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Requisition as ModelsRequisition;
use CodeIgniter\HTTP\ResponseInterface;

class Requisition extends BaseController
{

    public function pettyCashIndex()
    {
        $requisitions = model(ModelsRequisition::class);
        return view('forms/petty-cash', [
            ...self::$ADD_USER_CONFIG,
            'requisitions' => $requisitions
                ->where('Type', 'Petty_Cash')
                ->where('AccountID', $this->session->get('user')->ID)
                ->findAll()
        ]);
    }

    public function advancedSalariesIndex()
    {
        $requisitions = model(ModelsRequisition::class);
        return view('forms/advanced-salary', [
            ...self::$ADD_USER_CONFIG,
            'requisitions' => $requisitions
                ->where('Type', 'Advcanced_Salary')
                ->where('AccountID', $this->session->get('user')->ID)
                ->findAll()
        ]);
    }

    public function travelAndSubsistenciesIndex()
    {
        $requisitions = model(ModelsRequisition::class);
        return view('forms/travel-and-subsistency', [
            ...self::$ADD_USER_CONFIG,
            'requisitions' => $requisitions
                ->where('Type', 'Travel_Subsistence')
                ->where('AccountID', $this->session->get('user')->ID)
                ->findAll()
        ]);
    }
}
