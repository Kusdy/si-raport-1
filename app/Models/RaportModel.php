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

    public function getRaportData()
    {
        // Lakukan join antara tb_raport, tb_siswa, tb_guru, tb_mapel, dan tb_tahun_ajar
        $this->join('tb_siswa', 'tb_raport.id_siswa = tb_siswa.id_siswa');
        $this->join('tb_guru', 'tb_raport.id_guru = tb_guru.id_guru');
        $this->join('tb_mapel', 'tb_raport.id_mapel = tb_mapel.id_mapel');
        $this->join('tb_tahun_ajar', 'tb_raport.id_thn_ajar = tb_tahun_ajar.id_thn_ajar');
        $this->join('tb_kelas', 'tb_raport.id_kelas = tb_kelas.id_kelas');
        
        // Pilih kolom yang ingin Anda ambil
        $this->select('tb_raport.*, tb_siswa.nama_siswa, tb_guru.nama_guru, tb_mapel.mata_pelajaran, tb_tahun_ajar.tahun, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan,');

        // Lakukan query dan kembalikan hasilnya
        return $this->findAll();
    }
}