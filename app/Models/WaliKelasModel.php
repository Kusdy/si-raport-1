<?php

namespace App\Models;

use CodeIgniter\Model;

class WaliKelasModel extends Model
{
    protected $table            = 'tb_wali_kelas';
    protected $primaryKey       = 'id_wali_kelas';
    
    protected $allowedFields    = [
        'id_guru',
        'id_kelas'
    ];

    public function getWaliKelasWithGuru()
    {
        return $this->db->table($this->table)
        ->join('tb_guru', 'tb_wali_kelas.id_guru = tb_guru.id_guru')
        ->select('tb_wali_kelas.*, tb_guru.nama_guru')
        ->get()
        ->getResultArray();
    }
    
    public function getWaliKelasWithGuruAndKelas()
    {
        return $this->db->table($this->table)
            ->join('tb_guru', 'tb_wali_kelas.id_guru = tb_guru.id_guru')
            ->join('tb_kelas', 'tb_wali_kelas.id_kelas = tb_kelas.id_kelas')
            ->select('tb_wali_kelas.id_wali_kelas, tb_guru.nama_guru, tb_kelas.kelas, tb_kelas.tingkat, tb_kelas.jurusan')
            ->get()
            ->getResultArray();
    }

}