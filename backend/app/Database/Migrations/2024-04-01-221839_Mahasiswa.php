<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'NIM'               => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'nama_mahasiswa'    => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'email'             => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
        ]);

        $this->forge->addKey('NIM', true);
        $this->forge->createTable('Mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('Mahasiswa');
    }
}
