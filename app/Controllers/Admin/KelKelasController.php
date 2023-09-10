<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;

class KelKelasController extends BaseController
{
    public function index(): string
    {
        $model = new KelasModel();
        $kelas = $model->findAll();

        $data = [
            'title' => 'Data Kelas',
            'kelas' => $kelas
        ];

        $data['active'] = 'kelas';
        return view('pages/admin/kelola_kelas/index', $data);
    }

    public function add()
    {
        $model = new KelasModel();

        $validationRules = [
            'tingkat' => 'required',
            'kelas' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'tingkat' => $this->request->getPost('tingkat'),
            'kelas' => $this->request->getPost('kelas'),
            'jurusan' => $this->request->getPost('jurusan'),
        ];

        $cekKesamaan = $model->where('tingkat', $data['tingkat'])
        ->where('kelas', $data['kelas'])
        ->countAllResults();

        if ($cekKesamaan > 0) {
            return redirect()->to('admin/kelola_kelas')->withInput()->with('error', 'Tingkat Kelas sudah ada.');
        }

        $model->insert($data);

        return redirect()->back()->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = new KelasModel();

        $data = $model->find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data kelas tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'tingkat' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required'
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $tingkat = $this->request->getPost('tingkat');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');

        $existingData = $model->where('tingkat', $tingkat)
        ->where('kelas', $kelas)
        ->first();

        if ($existingData && $existingData['id_kelas'] !== $id) {
            return redirect()->to('admin/kelola_kelas')->with('error', 'Data sudah ada dalam database');
        }

        $updatedData = [
            'tingkat' => $tingkat,
            'kelas' => $kelas,
            'jurusan' => $jurusan
        ];
        $model->update($id, $updatedData);

        return redirect()->to('admin/kelola_kelas')->with('success', 'Data kelas berhasil diperbarui');
    }

    private function isDataChanged($newData, $existingData)
    {
        return $newData['tingkat'] !== $existingData['tingkat'] ||
        $newData['kelas'] !== $existingData['kelas'];
    }

    public function delete($id)
    {
        $kelasModel = new KelasModel();
        $kelas = $kelasModel->find($id);

        if ($kelas) {
            $kelasModel->delete($id);

            session()->setFlashdata('success', 'Data kelas berhasil dihapus.');
        }
        return redirect()->back();
    }
}
