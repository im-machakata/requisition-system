<?php

namespace App\Database\Seeds;

use App\Entities\Account as EntitiesAccount;
use App\Entities\Employee as EntitiesEmployee;
use App\Models\Account;
use App\Models\Employee;
use CodeIgniter\Database\Seeder;

class Accounts extends Seeder
{
    public function run()
    {
        $accounts =  model(Account::class);
        $employees = model(Employee::class);

        $adminAccount = new EntitiesAccount();
        $adminInfo = new EntitiesEmployee();

        // create a new login account for the default user
        $adminAccount
            ->setUsername(env('default.login.admin.username'))
            ->setPassword(password_hash(env('default.login.admin.password'), PASSWORD_DEFAULT));
        $accounts->save($adminAccount);

        // add personal identification details for the user
        $adminInfo->fill([
            'Name' => 'John',
            'Surname' => 'Doe',
            'Gender' => 'Male',
            'AccountID' => $accounts->getInsertID(),
            'DepartmentID' => '1',
            // 'Phone' => '0781234567',
            // 'Email' => 'john.doe@example.com',
        ]);

        // save the details to the database
        $employees->save($adminInfo);
    }
}
