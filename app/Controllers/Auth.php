<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Employee;
use App\Models\Account;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
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
        $foundEmployee = $accounts->where('Username', $employee->username)->first();

        if (!$foundEmployee) {
            return view('auth/login', [
                'error' => 'Invalid username or password'
            ]);
        }

        // password has to be hashed before comparing, but disabled for plain passwords to work
        // if (!password_verify($employee->password, $foundEmployee->password)) {
        if ($employee->password !== $foundEmployee->Password) {
            return view('auth/login', [
                'error' => 'Invalid username or password'
            ]);
        }

        // save the employee data to the session
        session()->set('user', $foundEmployee);

        // redirect to the home page
        return $this->response->redirect('/');
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
