<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KelasModel;
use App\Models\SemesterModel;
use App\Models\TahunModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $user = $model->findAll();

        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();

        $semesterModel = new SemesterModel();
        $semester = $semesterModel->findAll();

        $tahunModel = new TahunModel();
        $tahun = $tahunModel->findAll();

        if ($this->request->getMethod() === 'post') {
            return $this->search();
        }

        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'user' => $user,
            'tahun' => $tahun,
            'semester' => $semester,
            'kelas' => $kelas,
        ];
        return view('pages/admin/index', $data);
    }

    public function search()
    {
    // Ambil inputan pencarian dari form
        $searchTerm = $this->request->getVar('search');

    // Inisialisasi model-model
        $userModel = new UserModel();
        $kelasModel = new KelasModel();
        $semesterModel = new SemesterModel();
        $tahunModel = new TahunModel();

    // Inisialisasi array kosong untuk hasil pencarian
        $user = [];
        $kelas = [];
        $semester = [];
        $tahun = [];

    // Cari data dari model sesuai dengan kata kunci pencarian jika $searchTerm tidak null
        // Cari data dari model sesuai dengan kata kunci pencarian jika $searchTerm tidak null
        if ($searchTerm !== null) {
            $user = $userModel->orLike('nama', $searchTerm)
            ->orLike('role', $searchTerm) 
            ->orLike('email', $searchTerm) 
            ->findAll();
            $kelas = $kelasModel->orLike('kelas', $searchTerm)
            ->orLike('tingkat', $searchTerm) 
            ->orLike('jurusan', $searchTerm) 
            ->findAll();
            $semester = $semesterModel->orLike('semester', $searchTerm)
            ->orLike('ket_semester', $searchTerm)
            ->findAll();
            $tahun = $tahunModel->orLike('tahun', $searchTerm)->findAll();

        // Cek jika hasil pencarian ditemukan
            if (!empty($user)) {
            // Jika ditemukan, redirect ke halaman user
                return redirect()->to('admin/data-pengguna');
            } elseif (!empty($kelas)) {
            // Jika ditemukan, redirect ke halaman kelas
                return redirect()->to('admin/kelola_kelas');
            } elseif (!empty($semester)) {
            // Jika ditemukan, redirect ke halaman semester
                return redirect()->to('admin/kelola_semester');
            } elseif (!empty($tahun)) {
            // Jika ditemukan, redirect ke halaman tahun
                return redirect()->to('admin/kelola_tahun_ajar');
            } else {
            // Jika tidak ada hasil, set pesan alert dalam session
                session()->setFlashdata('error', 'Data tidak ditemukan.');
            // Redirect kembali ke halaman sebelumnya
                return redirect()->back();
            }
        }

        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'user' => $user,
            'tahun' => $tahun,
            'semester' => $semester,
            'kelas' => $kelas,
        ];

        return view('pages/admin/index', $data);
    }

}
