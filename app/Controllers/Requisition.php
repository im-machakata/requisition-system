<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Requisition as EntitiesRequisition;
use App\Models\Requisition as ModelsRequisition;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Psr\Log\LoggerInterface;

class Requisition extends BaseController
{
    /**
     * Holds the requisition pager from the model for each request
     *
     * @var ModelsRequisition
     */
    private $requisitions;
    
    /**
     * Store requisition view parameters
     *
     * @var array
     */
    private static $VIEW_PARAMS = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // initialize requisitions model
        $this->requisitions = model(ModelsRequisition::class);

        // add the pagination pager from the model to the default user config coz, D.R.Y
        // we use a pointer so that we don't get stale data (which is null at initController)
        // but actually call the function and get the latest data
        self::$ADD_USER_CONFIG['pager'] = &$this->requisitions->pager;
        self::$VIEW_PARAMS = self::$ADD_USER_CONFIG;
    }
    public function pettyCashIndex()
    {
        self::$VIEW_PARAMS['requisition'] = $this->requisitions->getPettyCash($this->account->ID);
        return view('forms/petty-cash', self::$VIEW_PARAMS);
    }
    public function recordPettyCash()
    {
        $formIsValid = $this->validate([
            'Amount' => 'required|numeric|min_length[1]|max_length[15]',
            'Reason' => 'required|min_length[15]|max_length[255]'
        ]);

        // if form data is invalid, show errors
        if (!$formIsValid) {
            return view('forms/petty-cash', [
                ...self::$ADD_USER_CONFIG,
                'error' => $this->validator->getErrors(),
                'requisitions' => $this->requisitions->getPettyCash($this->account->ID),
            ]);
        }

        /* 
        * SUGGESTION
        * Check for duplicates for that specific day
        **/

        // fill in and save new petty cash requisition
        $requisition = new EntitiesRequisition($this->validator->getValidated());
        $requisition->AccountID = $this->account->ID;
        $requisition->Type = $this->requisitions::PETTY_CASH;
        $recorded = $this->requisitions->save($requisition);

        return view('forms/petty-cash', [
            ...self::$ADD_USER_CONFIG,
            'success' => 'Petty cash has been recorded.',
            'requisitions' => $this->requisitions->getPettyCash($this->account->ID),
        ]);
    }

    public function advancedSalariesIndex()
    {
        return view('forms/advanced-salary', [
            ...self::$ADD_USER_CONFIG,
            'requisitions' => $this->requisitions->getAdvancedSalaries($this->account->ID),
        ]);
    }
    public function recordAdvancedSalaries()
    {
        $formIsValid = $this->validate([
            'Amount' => 'required|numeric|min_length[1]|max_length[15]',
            'Reason' => 'required|min_length[25]|max_length[255]'
        ]);

        // if form data is invalid, show errors
        if (!$formIsValid) {
            return view('forms/advanced-salary', [
                ...self::$ADD_USER_CONFIG,
                'error' => $this->validator->getErrors(),
                'requisitions' => $this->requisitions->getAdvancedSalaries($this->account->ID),
            ]);
        }

        /* 
        * SUGGESTION
        * Check for duplicates for that specific day
        **/

        // fill in and save new petty cash requisition
        $requisition = new EntitiesRequisition($this->validator->getValidated());
        $requisition->setType($this->requisitions::ADVANCED_SALARY);
        $requisition->setAccountID($this->account->ID);
        $recorded = $this->requisitions->save($requisition);

        return view('forms/advanced-salary', [
            ...self::$ADD_USER_CONFIG,
            'success' => 'Your request has been submitted.',
            'requisitions' => $this->requisitions->getAdvancedSalaries($this->account->ID),
        ]);
    }

    public function travelAndSubsistenciesIndex()
    {
        return view('forms/travel-and-subsistency', [
            ...self::$ADD_USER_CONFIG,
            'requisitions' => $this->requisitions->getTravelAndSubsistencies($this->account->ID),
        ]);
    }

    public function recordTravelAndSubsistencies()
    {
        $formIsValid = $this->validate([
            'Amount' => 'required|numeric|max_length[12]',
            'Reason' => 'required|min_length[25]|max_length[255]',
            'OutFrom' => 'required|valid_date',
            'OutTo' => 'required|valid_date',
            'Days' => 'required|numeric|is_natural_no_zero'
        ]);
        if (!$formIsValid) {
            return view('forms/travel-and-subsistency', [
                ...self::$ADD_USER_CONFIG,
                'error' => $this->validator->getErrors(),
                'requisitions' => $this->requisitions->getTravelAndSubsistencies($this->account->ID),
            ]);
        }

        $requisition = new EntitiesRequisition($this->validator->getValidated());
        $requisition->setType($this->requisitions::TRAVEL_AND_SUBSISTENCIES);
        $requisition->setAccountID($this->account->ID);
        $this->requisitions->save($requisition);

        return view('forms/travel-and-subsistency', [
            ...self::$ADD_USER_CONFIG,
            'success' => 'Requisition has been recorded.',
            'requisitions' => $this->requisitions->getTravelAndSubsistencies($this->account->ID),
        ]);
    }
}
