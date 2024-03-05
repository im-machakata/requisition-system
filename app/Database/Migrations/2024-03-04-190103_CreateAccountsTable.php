<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type' => 'INT',
                'null' => true,
                'unique' => true,
                'constraint' => 8,
                'auto_increment' => true
            ],
            'Username' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'unique' => true
            ],
            'Password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('accounts', true);
    }

    public function down()
    {
        $this->forge->dropTable('accounts', true);
    }
}
