<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $user = $this->session->get('user');
        $department = strtolower($user->department);
        try {
            return view('home/' . $department);
        } catch (\Exception $e) {
            return view('home/index');
        }
    }
}
