<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'tb_guru';
    protected $primaryKey       = 'id_guru';
    protected $allowedFields    = [
        'id_kelas',
        'id_mapel',
        'nip',
        'nama_guru',
        'tgl_lahir',
        'jk',
        'email',
        'alamat',
        'no_hp',
        'foto',
    ];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}