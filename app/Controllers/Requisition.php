<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Requisition as EntitiesRequisition;
use App\Models\Requisition as ModelsRequisition;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;

class Requisition extends BaseController
{

    public function pettyCashIndex()
    {
        $requisitions = model(ModelsRequisition::class);
        return view('forms/petty-cash', [
            ...self::$ADD_USER_CONFIG,
            'requisitions' => $requisitions->getPettyCash($this->account->ID),
            'pager' => $requisitions->pager
        ]);
    }
    public function recordPettyCash()
    {
        $requisitions = model(ModelsRequisition::class);
        $formIsValid = $this->validate([
            'Amount' => 'required|numeric|min_length[1]|max_length[15]',
            'Reason' => 'required|min_length[15]|max_length[255]'
        ]);

        if (!$formIsValid) {
            return view('forms/petty-cash', [
                ...self::$ADD_USER_CONFIG,
                'error' => $this->validator->getErrors(),
                'requisitions' => $requisitions->getPettyCash($this->account->ID),
                'pager' => $requisitions->pager
            ]);
        }

        // fill in and save new petty cash requisition
        $requisition = new EntitiesRequisition($this->validator->getValidated());
        $requisition->AccountID = $this->account->ID;
        $requisition->Type = $requisitions::PETTY_CASH;
        $recorded = $requisitions->save($requisition);

        return view('forms/petty-cash', [
            ...self::$ADD_USER_CONFIG,
            'success' => 'Petty cash has been recorded.',
            'requisitions' => $requisitions->getPettyCash($this->account->ID),
            'pager' => $requisitions->pager
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
