<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTahunAjar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_thn_ajar' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_semester' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'tahun' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
        ]);

        $this->forge->addKey('id_thn_ajar', true);
        $this->forge->createTable('tb_tahun_ajar');
        $this->forge->addForeignKey('id_semester', 'tb_semester', 'id_semester', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('tb_tahun_ajar');
        
        $this->forge->dropForeignKey('tb_tahun_ajar', 'tb_tahun_ajar_id_semester_foreign');

        $this->forge->dropColumn('tb_tahun_ajar', 'id_semester');
    }
}
