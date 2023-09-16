<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MapelModel;

class KelMapelController extends BaseController
{
    public function index()
    {
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->findAll();

        $guruModel = new GuruModel();
        $guruOption = $guruModel->findAll();

        $mapelWithGuru = $mapelModel->select('tb_mapel.*, tb_guru.nama_guru')
            ->join('tb_guru', 'tb_mapel.id_guru = tb_guru.id_guru')
            ->findAll();

        if ($this->request->getMethod() === 'post') {
            return redirect()->to('admin/search');
        }

        $data = [
            'title'          => 'Data Mapel',
            'active'         => 'kelola mapel',
            'mapel'          => $mapelWithGuru,
            'guruOption'     => $guruOption,
        ];

        return view('pages/admin/kelola_mapel/index', $data);

    }

    public function add()
    {
        $model = new MapelModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'mata_pelajaran' => 'required',
            'id_guru' => 'required',
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $data = [
                'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
                'id_guru' => $this->request->getPost('id_guru'),
            ];

            // Lakukan pengecekan apakah operasi insert berhasil
            if ($model->insert($data)) {
                return redirect()->to(site_url('admin/kelola_mapel'))->with('success', 'Data mata pelajaran berhasil ditambahkan.');
            } else {
                // Penanganan kesalahan jika gagal insert
                return redirect()->to(site_url('admin/kelola_mapel'))->with('error', 'Gagal menambahkan data mata pelajaran.');
            }
        } else {
            // Penanganan kesalahan validasi input
            return redirect()->to(site_url('admin/kelola_mapel'))->with('error', $validation->getErrors());
        }
    }

    public function update($id)
    {
        $mapelModel = new MapelModel();

        $data = $mapelModel->find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data mata pelajaran tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'mata_pelajaran' => 'required',
            'id_guru' => 'required',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $id_guru = $this->request->getPost('id_guru');
        $mata_pelajaran = $this->request->getPost('mata_pelajaran');

        $existingData = $mapelModel->where('id_guru', $id_guru)
        ->where('mata_pelajaran', $mata_pelajaran)
        ->first();

        if ($existingData && $existingData['id_kelas'] !== $id) {
            return redirect()->to('admin/kelola_mapel')->with('error', 'Data sudah ada dalam database');
        }

        $updatedData = [
            'id_guru' => $id_guru,
            'mata_pelajaran' => $mata_pelajaran,
        ];
        $mapelModel->update($id, $updatedData);

        return redirect()->to('admin/kelola_mapel')->with('success', 'Data mata pelajaran berhasil diperbarui');
    }

    public function delete($id)
    {
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->find($id);

        if ($mapel) {
            $mapelModel->delete($id);

            session()->setFlashdata('success', 'Data mata pelajaran berhasil dihapus.');
        }
        return redirect()->back();
    }
}