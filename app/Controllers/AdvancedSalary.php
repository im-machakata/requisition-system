<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdvancedSalary extends BaseController
{
    public function index()
    {
        return view('forms/advanced-salary');
    }
}
