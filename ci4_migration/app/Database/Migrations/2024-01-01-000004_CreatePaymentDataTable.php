<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @context7 /codeigniter/migration
 * @description Creates the payment_data table for storing payment information
 * @example 
 * // Run migration
 * php spark migrate
 */
class CreatePaymentDataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'registrant_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'unique'     => true,
            ],
            'payment_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'amount' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'verification_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'verified' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'message' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('registrant_id');
        $this->forge->addForeignKey('registrant_id', 'registrants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment_data');
    }

    public function down()
    {
        $this->forge->dropTable('payment_data');
    }
}