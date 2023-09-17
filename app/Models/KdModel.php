<?php

namespace App\Models;

use CodeIgniter\Model;

class KdModel extends Model
{
    protected $table = 'tb_kd';
    protected $primaryKey = 'id_kd';
    protected $allowedFields = ['id_mapel', 'deskripsi_kd', 'indikator_kd', 'materi_pembelajaran', 'penilaian'];

    public function JokotMapelNganggoNingKdHaha()
    {
        return $this->db->table($this->table)
        ->join('tb_mapel', 'tb_kd.id_mapel = tb_mapel.id_mapel')
        ->select('tb_kd.*, tb_mapel.mata_pelajaran')
        ->get()
        ->getResultArray();
    }
}
