<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Account;
use App\Entities\Requisition as EntitiesRequisition;
use App\Models\Account as ModelsAccount;
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
        self::$VIEW_PARAMS['requisitions'] = $this->requisitions->getPettyCash($this->account->ID);
        return view('forms/petty-cash', self::$VIEW_PARAMS);
    }
    public function recordPettyCash()
    {
        $formIsValid = $this->validate([
            'Amount' => 'required|numeric|min_length[1]|max_length[15]',
            'Reason' => 'required|min_length[25]|max_length[255]'
        ]);

        // if form data is invalid, show errors
        if (!$formIsValid) {
            self::$VIEW_PARAMS['requisitions'] = $this->requisitions
                ->getPettyCash($this->account->ID);
            self::$VIEW_PARAMS['error'] = $this->validator->getErrors();
            return view('forms/petty-cash', self::$VIEW_PARAMS);
        }

        /* 
        * SUGGESTION
        * Check for duplicates for that specific day
        **/

        // fill in and save new petty cash requisition
        $requisition = new EntitiesRequisition($this->validator->getValidated());
        $requisition->setAccountID($this->account->ID);
        $requisition->setType($this->requisitions::PETTY_CASH);
        $this->requisitions->save($requisition);

        // save responses
        self::$VIEW_PARAMS['success'] = 'Petty cash has been recorded.';
        self::$VIEW_PARAMS['requisitions'] = $this->requisitions
            ->getPettyCash($this->account->ID);
        return view('forms/petty-cash', self::$VIEW_PARAMS);
    }

    public function advancedSalariesIndex()
    {
        self::$VIEW_PARAMS['requisitions'] = $this->requisitions
            ->getAdvancedSalaries($this->account->ID);
        return view('forms/advanced-salary', self::$VIEW_PARAMS);
    }
    public function recordAdvancedSalaries()
    {
        $formIsValid = $this->validate([
            'Amount' => 'required|numeric|min_length[1]|max_length[15]',
            'Reason' => 'required|min_length[25]|max_length[255]'
        ]);

        // if form data is invalid, show errors
        if (!$formIsValid) {
            self::$VIEW_PARAMS['requisitions'] = $this->requisitions
                ->getAdvancedSalaries($this->account->ID);
            self::$VIEW_PARAMS['error'] = $this->validator->getErrors();
            return view('forms/advanced-salary', self::$VIEW_PARAMS);
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

        self::$VIEW_PARAMS['success'] = 'Your request has been submitted.';
        self::$VIEW_PARAMS['requisitions'] = $this->requisitions
            ->getAdvancedSalaries($this->account->ID);
        return view('forms/advanced-salary', self::$VIEW_PARAMS);
    }

    public function travelAndSubsistenciesIndex()
    {
        self::$VIEW_PARAMS['requisitions'] = $this->requisitions
            ->getTravelAndSubsistencies($this->account->ID);
        return view('forms/travel-and-subsistency', self::$VIEW_PARAMS);
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

    public function viewUserReportsIndex()
    {
        $results = [];
        $account = new Account($this->request->getGet());
        $usernames = model(ModelsAccount::class)
            ->select('Username, CONCAT(employees.Name," ",Surname) AS Names')
            ->getUsers(false);

        if ($account->Username) {
            // populate results
            $results = $this->requisitions
                ->filterByUser($account->Username)
                ->getRequisitions()
                ->findAll();

            // get users names
            $account->Names = model(ModelsAccount::class)
                ->select('CONCAT(employees.Name," ",Surname) AS Names')
                ->filterByUser($account->Username)
                ->getUsers(false)[0]->Names;
        }

        return view('forms/user-reports', [
            ...self::$VIEW_PARAMS,
            'results' => $results,
            'usernames' => $usernames,
            'account' => $account
        ]);
    }

    public function authorizeRequisitionsIndex()
    {
        self::$VIEW_PARAMS['requisitions'] = $this->requisitions
            ->select('requisitions.ID AS ReqID, requisitions.UpdatedAt, requisitions.Amount, requisitions.Reason, CONCAT(Name, " ", Surname) AS Names')
            ->where('Status', 'Submitted')
            ->getRequisitions()
            ->getOwners()
            ->paginate(6);
        return view('forms/authorize-requisitions', self::$VIEW_PARAMS);
    }

    public function authorizeRequisitions()
    {
        return view('forms/authorize-requisitions', [
            ...self::$VIEW_PARAMS,
        ]);
    }
}
