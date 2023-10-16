<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbRaport extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_raport' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_guru' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_mapel' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_thn_ajar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nilai_uts' => [
                'type' => 'FLOAT',
            ],
            'nilai_uas' => [
                'type' => 'FLOAT',
            ],
            'rata_rata' => [
                'type' => 'FLOAT',
            ],
        ]);

        $this->forge->addKey('id_raport', true);
        $this->forge->createTable('tb_raport');
        $this->forge->addForeignKey('id_siswa', 'tb_siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_guru', 'tb_guru', 'id_guru', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kelas', 'tb_tahun_ajar', 'id_kelas', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_thn_ajar', 'tb_mapel', 'id_mapel', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_mapel', 'tb_mapel', 'id_mapel', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('tb_raport');
    }
}
