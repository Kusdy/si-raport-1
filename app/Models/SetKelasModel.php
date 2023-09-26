<?php

namespace App\Models;

use CodeIgniter\Model;

class SetKelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_set_kelas';
    protected $primaryKey       = 'id_set_kelas';
    protected $allowedFields    = [
        'id_mapel', 
        'id_wali_kelas'
    ];

    public function getSetKelasWithGuruAndMapel()
    {
        return $this->join('tb_wali_kelas', 'tb_wali_kelas.id_wali_kelas = tb_set_kelas.id_wali_kelas')
            ->join('tb_guru', 'tb_guru.id_guru = tb_wali_kelas.id_guru')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_wali_kelas.id_kelas')
            ->select('tb_set_kelas.*, tb_guru.nama_guru, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan')
            ->findAll();
    }

}