<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Employee;
use App\Models\Account;
use App\Models\Department;
use App\Models\Employee as ModelsEmployee;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        $departments = model(Department::class)->findAll();
        return view('auth/add-user', [
            'departments' => $departments
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
                'error' => $this->validator->getErrors()
            ]);
        }

        $accounts = model(Account::class);
        $userAccount = $accounts->where('Username', $employee->username)->first();
        $passwordMatches = false;

        if ($userAccount) {
            $passwordMatches = $employee->password === $userAccount->Password;
        }

        // password has to be hashed before comparing, but disabled for plain passwords to work
        // if (!password_verify($employee->password, $userAccount->password)) {
        if (!$userAccount || !$passwordMatches) {
            return view('auth/login', [
                'error' => 'Invalid username or password'
            ]);
        }

        // find the employee department
        $employee = model(ModelsEmployee::class)->where('AccountID', $userAccount->ID)->first();
        $departments = model(Department::class)->find($employee->DepartmentID);
        $userAccount->department = $departments->Name;

        // save the employee data to the session
        session()->set('user', $userAccount);

        // redirect to the home page
        return $this->response->redirect('/');
    }

    public function createAccount()
    {
        $this->validate([
            'name' => 'required|min_length[3]|max_length[25]',
            'surname' => 'required|min_length[3]|max_length[25]',
        ]);
        if (!$this->validator->run()) {
            return view('auth/add-user', [
                'error' => $this->validator->getErrors(),
            ]);
        }
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
        $accounts->save($employee);

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
