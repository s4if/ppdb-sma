<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @context7 /codeigniter/migration
 * @description Creates the registrants table for storing student registration data
 * @example 
 * // Run migration
 * php spark migrate
 */
class CreateRegistrantsTable extends Migration
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
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'unique'     => true,
                'null'       => false,
            ],
            'reg_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'unique'     => true,
                'null'       => true,
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 4,
                'unique'     => true,
                'null'       => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'gender' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
            ],
            'previous_school' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'nisn' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'cp' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'program' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
            ],
            'selection_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
            ],
            'rel_to_regular' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
                'null'       => true,
            ],
            'rel_to_regular_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
                'null'       => true,
            ],
            'registration_time' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'father_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'mother_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'guardian_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'rapor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'initial_cost' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'subscription_cost' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'land_donation' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'qurban' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'main_parent' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'verified' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'finalized' => [
                'type' => 'BOOLEAN',
                'null' => true,
                'default' => 0,
            ],
            'deleted' => [
                'type' => 'BOOLEAN',
                'null' => true,
                'default' => 0,
            ],
            'gelombang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'entry_year' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
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
        $this->forge->addKey('username', false, true);
        $this->forge->addKey('reg_id', false, true);
        $this->forge->addKey('kode', false, true);
        $this->forge->addForeignKey('father_id', 'parents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mother_id', 'parents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('guardian_id', 'parents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('rapor_id', 'rapor', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('registrants');
    }

    public function down()
    {
        $this->forge->dropTable('registrants');
    }
}