<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\TahunModel;
use App\Models\WaliKelasModel;

class KelWalikelasController extends BaseController
{
    public function index()
    {
        $walikelasModel = new WaliKelasModel();
        // $waliKelas = $walikelasModel->findAll();
        $waliKelasWithGuru = $walikelasModel->select('tb_wali_kelas.*, tb_guru.nama_guru, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan')
        ->join('tb_guru', 'tb_wali_kelas.id_guru = tb_guru.id_guru')
        ->join('tb_kelas', 'tb_wali_kelas.id_kelas = tb_kelas.id_kelas')
        ->findAll();
        
        $data = [
            'title'     => 'Data Wali Kelas',
            'active'    => 'walikelas',
            'waliKelas' => $waliKelasWithGuru,

        ];
        return view('pages/admin/kelola_walikelas/index', $data);
    }

    public function new(){

        $guruModel = new GuruModel();
        $guruOption = $guruModel->findAll();

        $kelasModel = new KelasModel();
        $tahunModel = new TahunModel();
        $kelasOption = $kelasModel->findAll();

        $data = [
            'title' => 'Tambah Data Wali Kelas',
            'active' => 'walikelas',
            'guruOption'    => $guruOption,
            'kelasOption'    => $kelasOption,
        ];
        return view('pages/admin/kelola_walikelas/tambah', $data);
    }

    public function add()
    {
        $walikelasModel = new WaliKelasModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_kelas' => 'required|numeric',
            'id_guru' => 'required|numeric',
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $data = [
                'id_kelas' => $this->request->getPost('id_kelas'),
                'id_guru' => $this->request->getPost('id_guru'),
            ];

            // Lakukan pengecekan apakah operasi insert berhasil
            if ($walikelasModel->insert($data)) {
                return redirect()->to(site_url('admin/kelola_walikelas'))->with('success', 'Data wali kelas berhasil ditambahkan.');
            } else {
                // Penanganan kesalahan jika gagal insert
                return redirect()->to(site_url('admin/kelola_walikelas'))->with('error', 'Gagal menambahkan data wali kelas.');
            }
        } else {
            // Penanganan kesalahan validasi input
            return redirect()->to(site_url('admin/kelola_walikelas'))->with('error', $validation->getErrors());
        }
    }


    public function edit($id)
    {
        $walikelasModel = new WaliKelasModel();
        $guruModel = new GuruModel();
        $guruOption = $guruModel->findAll();

        $kelasModel = new KelasModel();
        $kelasOption = $kelasModel->findAll();

        $data = [
            'title'     => 'Edit Data Wali Kelas',
            'active'    => 'walikelas',
            'waliKelas' => $walikelasModel->find($id),
            'guruOption'=> $guruOption,   
            'kelasOption'=> $kelasOption,   
        ];
        return view('pages/admin/kelola_walikelas/edit', $data);
    }

    public function update($id)
    {
        $walikelasModel = new WaliKelasModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_kelas' => 'required|numeric',
            'id_guru' => 'required|numeric',
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $data = [
                'id_kelas' => $this->request->getPost('id_kelas'),
                'id_guru' => $this->request->getPost('id_guru'),
            ];

            // Lakukan pengecekan apakah operasi update berhasil
            if ($walikelasModel->update($id, $data)) {
                return redirect()->to(site_url('admin/kelola_walikelas'))->with('success', 'Data wali kelas berhasil diperbarui.');
            } else {
                // Penanganan kesalahan jika gagal update
                return redirect()->to(site_url('admin/kelola_walikelas'))->with('error', 'Gagal memperbarui data wali kelas.');
            }
        } else {
            // Penanganan kesalahan validasi input
            return redirect()->to(site_url('admin/kelola_walikelas'))->with('error', $validation->getErrors());
        }
    }


    public function delete($id)
    {
        $walikelasModel = new WaliKelasModel();
        $waliKelas = $walikelasModel->find($id);

        if (!$waliKelas) {
            return redirect()->to(site_url('admin/kelola_walikelas'))->with('error', 'Data wali kelas tidak ditemukan.');
        }

        // Hapus data dari database
        $walikelasModel->delete($id);

        return redirect()->to(site_url('admin/kelola_walikelas'))->with('success', 'Data wali kelas berhasil dihapus.');
    }
}