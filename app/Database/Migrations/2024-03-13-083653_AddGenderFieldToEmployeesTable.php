<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGenderFieldToEmployeesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('employees', [
            'Gender' => [
                'type' => 'ENUM',
                'constraint' => [
                    'None',
                    'Male',
                    'Female'
                ],
                'default' => 'None'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('employees', 'Gender');
    }
}
