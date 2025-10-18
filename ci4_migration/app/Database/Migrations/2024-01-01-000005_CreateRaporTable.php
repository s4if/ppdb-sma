<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @context7 /codeigniter/migration
 * @description Creates the rapor table for storing student report card values
 * @example 
 * // Run migration
 * php spark migrate
 */
class CreateRaporTable extends Migration
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
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        
        // Add all the rapor fields for each subject and semester
        $subjects = ['mtk', 'ipa', 'ips', 'ind', 'ing'];
        $types = ['nilai', 'kkm'];
        
        foreach ($subjects as $subject) {
            foreach ($types as $type) {
                for ($semester = 1; $semester <= 6; $semester++) {
                    $this->forge->addField([
                        $type . '_' . $subject . '_' . $semester => [
                            'type'       => 'INT',
                            'constraint' => 11,
                            'null'       => true,
                        ],
                    ]);
                }
            }
        }
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('rapor');
    }

    public function down()
    {
        $this->forge->dropTable('rapor');
    }
}