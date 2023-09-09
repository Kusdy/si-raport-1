<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSemester extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_semester' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'semester' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'ket_semester' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
        ]);

        $this->forge->addKey('id_semester', true);
        $this->forge->createTable('tb_semester');
    }

    public function down()
    {
        $this->forge->dropTable('tb_semester');
    }
}
