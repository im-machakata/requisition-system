<?php

namespace App\Controllers;

use App\Entities\Employee;

class Home extends BaseController
{
    public function index(): string
    {
        $user = session('user');
        switch ($user->department) {
            case "ACCOUNTS":
                return view('home/accounts');
            case "SUPERVISOR":
                return view('home/supervisor');
            default:
                return view('home/index');
        }
    }
}
