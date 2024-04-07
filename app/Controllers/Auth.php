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
    public function login()
    {
        return view('auth/login', self::$ADD_USER_CONFIG);
    }

    public function register()
    {
        $accounts = model(Account::class);
        return view('auth/add-user', [
            ...self::$ADD_USER_CONFIG,
            'users' => $accounts->getUsers(),
            'pager' => $accounts->pager
        ]);
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
        $this->session->set('user', $userAccount);

        // redirect to the home page
        return $this->response->redirect('/');
    }

    public function createAccount()
    {
        $accounts = model(Account::class);
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
                'users' => $accounts->getUsers(),
                'pager' => $accounts->pager,
                ...self::$ADD_USER_CONFIG,
            ]);
        }

        // step 1: create an auth account 
        // so that the user will be able to log in
        $accounts = model(Account::class);
        $newAccount = new EntitiesAccount($this->validator->getValidated());

        // hash password 
        $newAccount->Password = password_hash($newAccount->Password, PASSWORD_DEFAULT);

        // save auth account to db
        $accounts->save($newAccount);

        // step 2: create an employee account
        // to store the user details
        $employees = model(ModelsEmployee::class);
        $newEmployee = new Employee($this->validator->getValidated());

        // get employees account id, required to link employee 
        $newEmployee->AccountID = $accounts->getInsertID();

        // save employee to database
        $employees->save($newEmployee);
        
        return view('auth/add-user', [
            ...self::$ADD_USER_CONFIG,
            'users' => $accounts->getUsers(),
            'pager' => $accounts->pager,
            'success'=>'New user has been added.'
        ]);
    }

    public function viewPassword()
    {
        return view('auth/change-password');
    }
    public function userReports()
    {
        $accounts = model(Account::class);
        return view('auth/user-reports', [
            ...self::$ADD_USER_CONFIG,
            'users' => $accounts->getUsers(),
            'pager' => $accounts->pager
        ]);
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
        $employee = $this->session->get('user');
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
        if ($this->session->get('user')) {
            // delete session data
            $this->session->remove('user');
        }

        // redirect to the home page
        return $this->response->redirect('/auth/login');
    }
}
