<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbKd extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kd' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_mapel' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'deskripsi_kd' => [
                'type' => 'TEXT',
            ],
            'indikator_kd' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'materi_pembelajaran' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'penilaian' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id_kd', true);
        $this->forge->createTable('tb_kd');
        $this->forge->addForeignKey('id_mapel', 'tb_mapel', 'id_mapel', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kd');
        
        $this->forge->dropForeignKey('tb_kd', 'tb_kd_id_mapel_foreign');

        $this->forge->dropColumn('tb_kd', 'id_mapel');
    }
}
