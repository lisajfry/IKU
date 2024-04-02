<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Iku3 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'iku3_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'NIDN' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'aktivitas_dosen' => [
                'type'       => 'ENUM',
                'constraint' => ['Bertridharma dikampus lain', 'Bekerja sebagai praktisi', 'Membimbing mahasiswa berprestasi'],
            ],
            'mahasiswa_bimbingan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true, // Allow NULL values
            ],
        ]);

        $this->forge->addPrimaryKey('iku3_id');
        $this->forge->addForeignKey('NIDN', 'dosen', 'NIDN', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mahasiswa_bimbingan', 'iku2', 'iku2_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('iku3');
    }

    public function down()
    {
        $this->forge->dropTable('iku3');
    }
}
