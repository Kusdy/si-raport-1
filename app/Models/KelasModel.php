<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'tb_kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['tingkat', 'kelas', 'jurusan'];
}
