<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Employee;
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
            'username' =>'required',
            'password' => 'required',
        ];

        // stop execution if the validation fails
        if(!$this->validate($sessionRules)){
            return view('auth/login', [
                'error' => $this->validator->getErrors()
            ]);
        }

        // todo: check if the username and password are correct

        // save the employee data to the session
        session()->set('user', $employee);

        // redirect to the home page
        return $this->response->redirect('/');
    }
}
