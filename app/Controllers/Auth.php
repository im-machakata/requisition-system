<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Account as EntitiesAccount;
use App\Entities\Employee;
use App\Models\Account;
use App\Models\Department;
use App\Models\Employee as ModelsEmployee;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Auth extends BaseController
{
    /**
     * Stores the default auth view functions such as old
     *
     * @var array
     */
    private static $ADD_USER_CONFIG = [];
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // perform any parent class functions
        parent::initController($request, $response, $logger);

        self::$ADD_USER_CONFIG['old'] = function ($key) {
            return $this->request->getPost($key);
        };
        // there's no need to load departments when user is not logged in
        if (!session()->get('user')) return;
        self::$ADD_USER_CONFIG['departments'] = model(Department::class)->findAll();
    }
    public function login()
    {
        return view('auth/login', self::$ADD_USER_CONFIG);
    }

    public function register()
    {
        return view('auth/add-user', self::$ADD_USER_CONFIG);
    }

    public function createSession()
    {
        $employee = new Employee($this->request->getPost());
        $sessionRules = [
            'username' => 'required',
            'password' => 'required',
        ];

        // stop execution if the validation fails
        if (!$this->validate($sessionRules)) {
            return view('auth/login', [
                'error' => $this->validator->getErrors(),
                ...self::$ADD_USER_CONFIG
            ]);
        }

        // find an account with that username
        $accounts = model(Account::class);
        $userAccount = $accounts->where('Username', $employee->username)->first();

        // declare password matches variable, defaulting to false
        $passwordMatches = false;

        // if acount was found, verify if password matches
        if ($userAccount) {
            $passwordMatches = password_verify($employee->password, $userAccount->Password);
        }

        // if password does not match or no account was found
        // return an error to the user
        if (!$userAccount || !$passwordMatches) {
            return view('auth/login', [
                'error' => 'Invalid username or password',
                ...self::$ADD_USER_CONFIG
            ]);
        }

        // find the employee department
        $employee = model(ModelsEmployee::class)->where('AccountID', $userAccount->ID)->first();
        $departments = model(Department::class)->find($employee->DepartmentID);

        // save department so that we know which menu to display
        $userAccount->department = $departments->Name;

        // save the employee data to the session
        session()->set('user', $userAccount);

        // redirect to the home page
        return $this->response->redirect('/');
    }

    public function createAccount()
    {
        $formDataIsValid = $this->validate([
            'Name' => 'required|min_length[3]|max_length[25]',
            'Surname' => 'required|min_length[3]|max_length[25]',
            'Phone' => 'required|min_length[9]|max_length[12]|numeric',
            'Username' => 'required|min_length[5]|max_length[25]|alpha|is_unique[accounts.Username]',
            'Email' => 'required|valid_email',
            'Password' => 'required|min_length[6]|max_length[25]',
            'DepartmentID' => 'required|numeric|is_not_unique[departments.ID]',
            'Gender' => 'required|in_list[Male,Female]',
        ]);

        // if validation failed, show errors
        if (!$formDataIsValid) {
            return view('auth/add-user', [
                // add error to existing variables
                'error' => $this->validator->getErrors(),
                ...self::$ADD_USER_CONFIG,
            ]);
        }

        // step 1: create an auth account 
        // so that the user will be able to log in
        $accounts = model(Account::class);
        $newAccount = new EntitiesAccount($this->request->getPost());

        // hash password 
        $newAccount->Password = password_hash($newAccount->Password, PASSWORD_DEFAULT);

        // save auth account to db
        $accounts->save($newAccount);

        // step 2: create an employee account
        // to store the user details
        $employees = model(ModelsEmployee::class);
        $newEmployee = new Employee($this->request->getPost());

        // get employees account id, required to link employee 
        $newEmployee->AccountID = $accounts->getInsertID();

        // save employee to database
        $employees->save($newEmployee);

        return redirect('/');
    }

    public function viewPassword()
    {
        return view('auth/change-password');
    }

    public function changePassword()
    {
        $formDataIsValid = $this->validate([
            'password' => 'required|min_length[6]|max_length[25]',
            'confirm_password' => 'required|matches[password]',
        ]);
        if (!$formDataIsValid) {
            return view('auth/change-password', [
                'error' => $this->validator->getErrors(),
            ]);
        }

        $accounts = model(Account::class);
        $employee = session()->get('user');
        $employee->Password = trim($this->validator->getValidated()['password']);

        // hash password
        $employee->Password = password_hash($employee->Password, PASSWORD_DEFAULT);

        // save new password
        $accounts->save($employee);

        // go to menu/home page
        return redirect('/');
    }

    public function logout()
    {

        // if session does not exist, do not try to delete it, duh!
        if (session()->get('user')) {
            // delete session data
            session()->remove('user');
        }

        // redirect to the home page
        return $this->response->redirect('/auth/login');
    }
}
