<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @context7 /codeigniter/migration
 * @description Creates the registrant_data table for storing detailed registrant information
 * @example 
 * // Run migration
 * php spark migrate
 */
class CreateRegistrantDataTable extends Migration
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
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => false,
            ],
            'nkk' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => false,
            ],
            'nak' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => false,
            ],
            'birth_place' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'birth_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'blood_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
            ],
            'child_order' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'siblings_count' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'street' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'RT' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'RW' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'village' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'district' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'province' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'postal_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'family_condition' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'nationality' => [
                'type'       => 'VARCHAR',
                'constraint' => 4,
                'null'       => false,
            ],
            'religion' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
            ],
            'hospital_sheets' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'physical_abnormalities' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'height' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'weight' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'stay_with' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'hobbies' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'achievements' => [
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
        $this->forge->createTable('registrant_data');
    }

    public function down()
    {
        $this->forge->dropTable('registrant_data');
    }
}