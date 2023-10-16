<?php

namespace App\Models;

use CodeIgniter\Model;

class RaportModel extends Model
{
    protected $table = 'tb_raport';
    protected $primaryKey = 'id_raport';
    protected $allowedFields = [
        'id_siswa',
        'id_guru',
        'id_mapel',
        'id_kelas',
        'id_thn_ajar',
        'nilai_uts',
        'nilai_uas',
        'rata_rata',
    ];

    public function getLaporanData()
    {
        // Mengambil data laporan dari tabel 'tb_raport'
        return $this->findAll();
    }
}
