<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type' => 'INT',
                'constraint' => 8,
                'unique' => true,
                'null' => true,
                'auto_increment' => true
            ],
            'AccountID' => [
                'type' => 'INT',
                'constraint' => 8,
            ],
            'Name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'Surname' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'Phone' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'Email' => [
                'type' => 'VARCHAR',
                'constraint' => '18',
            ],
            'DepartmentID' => [
                'type' => 'INT',
                'constraint' => '20',
            ],
            'CreatedAt' => [
                'type' => 'INT',
                'null' => true,
            ],
            'UpdatedAt' => [
                'type' => 'INT',
                'null' => true,
            ],
            'DeletedAt' => [
                'type' => 'INT',
                'null' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('ID');
        $this->forge->addForeignKey('AccountID', 'accounts', 'ID');
        $this->forge->addForeignKey('DepartmentID', 'departments', 'ID');
        $this->forge->createTable('employees', true);
    }

    public function down()
    {
        $this->forge->dropTable('employees', true);
    }
}
