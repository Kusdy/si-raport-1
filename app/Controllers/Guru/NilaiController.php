<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;

class NilaiController extends BaseController
{
    public function index()
    {
        $kelasModel = new KelasModel();
        $siswaModel = new SiswaModel();
        $kelasOption = $kelasModel->findAll();
        $siswa = $siswaModel
        ->select('tb_siswa.*, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->findAll();

        $selectedKelas = 'Semua Kelas';

        $data = [
            'title' => 'Data nilai',
            'kelasOption' => $kelasOption,
            'siswa' => $siswa,
            'selectedKelas' => $selectedKelas, 
        ];

        $data['active'] = 'Nilai';
        return view('pages/guru/nilai/index', $data);
    }


    public function search()
    {
        $selectedKelas = $this->request->getPost('kelas');

        $kelasModel = new KelasModel();
        $siswaModel = new SiswaModel();
        $kelasOption = $kelasModel->findAll();
        $siswa = [];

        if ($selectedKelas === 'Semua Kelas') {
            // Jika "Semua Kelas" dipilih, ambil semua data siswa
            $siswa = $siswaModel->select('tb_siswa.*, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan')
            ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
            ->findAll();
        } else {
            // Jika kelas tertentu dipilih, ambil hanya data siswa dari kelas tersebut
            $siswa = $siswaModel->select('tb_siswa.*, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan')
            ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
            ->where('tb_kelas.kelas', $selectedKelas)
            ->findAll();
        }

        // Data yang akan dikirimkan ke halaman tampilan
        $data = [
            'title' => 'Data nilai',
            'kelasOption' => $kelasOption,
            'siswa' => $siswa,
            'selectedKelas' => $selectedKelas,
        ];

        $data['active'] = 'Nilai';
        return view('pages/guru/nilai/index', $data);
    }
}
