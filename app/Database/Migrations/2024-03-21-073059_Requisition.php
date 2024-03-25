<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Requisition extends Migration
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
            'AccountID' => [
                'type' => 'INT',
                'constraint' => 8
            ],
            'Amount' => [
                'type' => 'DECIMAL',
                'constraint' => '12.2',
            ],
            'Reason' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'Type' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Petty_Cash',
                    'Travel_Subsistencies',
                    'Advanced_Salary',
                ],
            ],
            'OutFrom' => [
                'type' => 'DATE',
                'null' => true
            ],
            'OutTo' => [
                'type' => 'DATE',
                'null' => true
            ],
            'Status' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Submitted',
                    'Supervisor_Pending',
                    'Supervisor_Approved',
                    'Finance_Pending',
                    'Finance_Disbursed',
                    'Rejected'
                ],
                'default' => 'Submitted'
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
        $this->forge->createTable('requisitions');
    }

    public function down()
    {
        $this->forge->dropTable('requisitions');
    }
}
