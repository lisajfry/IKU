<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Iku1 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_alumni'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_alumni'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'status'            => [
                'type'           => 'ENUM',
                'constraint'     => ['mendapat pekerjaan', 'melanjutkan studi', 'wiraswasta'],
            ],
            'gaji'              => [
                'type'           => 'ENUM',
                'constraint'     => ['lebih dari 1.2xUMP', 'kurang dari 1.2xUMP', '0'],
            ],
            'masa_tunggu'       => [
                'type'           => 'ENUM',
                'constraint'     => ['kurang dari 6 bulan', 'antara 6 sampai 12bulan'],
            ],
        ]);

        $this->forge->addKey('id_alumni', true);
        $this->forge->createTable('iku1');
    }

    public function down()
    {
        $this->forge->dropTable('iku1');
    }
}
