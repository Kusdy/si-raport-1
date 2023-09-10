<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model
{
    protected $table = 'tb_semester';
    protected $primaryKey = 'id_semester';
    protected $allowedFields = ['semester', 'ket_semester'];
}
