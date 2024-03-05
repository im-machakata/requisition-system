<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDepartmentsTable extends Migration
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
            'Name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => true
            ], 
        ]);
        $this->forge->addPrimaryKey('ID');
        $this->forge->createTable('departments', true);
    }

    public function down()
    {
        $this->forge->dropTable('departments', true);
    }
}
