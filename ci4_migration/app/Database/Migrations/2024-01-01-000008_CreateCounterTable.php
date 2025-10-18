<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @context7 /codeigniter/migration
 * @description Creates the counter table for tracking registration numbers
 * @example 
 * // Run migration
 * php spark migrate
 */
class CreateCounterTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'primary_key' => true,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'male_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'default' => 0,
            ],
            'female_count' => [
                'type' => 'INT',
                'constraint' => 11,
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
        
        $this->forge->createTable('counter');
        
        // Insert initial counter record with ID 1
        $data = [
            'id' => 1,
            'date' => date('Y-m-d'),
            'male_count' => 0,
            'female_count' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('counter')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('counter');
    }
}