<?php

namespace App\Database\Seeds;

use App\Models\Department;
use CodeIgniter\Database\Seeder;

class Departments extends Seeder
{
    public function run()
    {
        $departments = model(Department::class);

        $departments->insert(['Name' => 'Admin']);
        $departments->insert(['Name' => 'Accounts']);
        $departments->insert(['Name' => 'Supervisor']);
    }
}
