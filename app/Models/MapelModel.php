<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{

    protected $table = 'tb_mapel';
    protected $primaryKey = 'id_mapel';
    protected $allowedFields = [
        'id_guru',
        'id_kelas',
        'mata_pelajaran',
    ];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}