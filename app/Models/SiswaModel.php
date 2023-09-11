<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'tb_siswa';
    protected $primaryKey       = 'id_siswa';
     protected $allowedFields = [
        'id_kelas',
        'id_tahun_ajar',
        'nis',
        'nama_siswa',
        'tgl_lahir',
        'jk',
        'nama_ibu',
        'nama_ayah',
        'email',
        'alamat',
        'no_hp',
        'foto',
    ];

    // Dates
    protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function getSiswaWithTahunAjar()
    {
        // // Lakukan join antara tb_siswa dan tb_tahun_ajar berdasarkan id_th_ajar
        // return $this->db->table($this->table)
        //     ->join('tb_guru', 'tb_wali_kelas.id_guru = tb_guru.id_guru')
        //     ->select('tb_wali_kelas.*, tb_guru.nama_guru')
        //     ->get()
        //     ->getResultArray();
    }
}