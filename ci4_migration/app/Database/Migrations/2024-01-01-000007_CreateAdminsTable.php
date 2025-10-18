<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @context7 /codeigniter/migration
 * @description Creates the admins table for storing administrator accounts
 * @example 
 * // Run migration
 * php spark migrate
 */
class CreateAdminsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'primary_key' => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'root' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => 0,
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
        
        $this->forge->createTable('admins');
    }

    public function down()
    {
        $this->forge->dropTable('admins');
    }
}