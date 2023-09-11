<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SemesterModel;

class KelSemesterController extends BaseController
{
    public function index(): string
    {
        $model = new SemesterModel();
        $semester = $model->findAll();

        if ($this->request->getMethod() === 'post') {
            return redirect()->to('admin/search');
        }

        $data = [
            'title' => 'Data Semester',
            'semester' => $semester
        ];

        $data['active'] = 'semester';
        return view('pages/admin/kelola_semester/index', $data);
    }

    public function add()
    {
        $model = new SemesterModel();

        $validationRules = [
            'semester' => 'required',
            'ket_semester' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'semester' => $this->request->getPost('semester'),
            'ket_semester' => $this->request->getPost('ket_semester'),
        ];

        $cekKesamaan = $model->where('semester', $data['semester'])
        ->where('ket_semester', $data['ket_semester'])
        ->countAllResults();

        if ($cekKesamaan > 0) {
            return redirect()->to('admin/kelola_semester')->withInput()->with('error', 'Semester sudah ada.');
        }

        $model->insert($data);

        return redirect()->back()->with('success', 'Data semester berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = new SemesterModel();

        $data = $model->find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data semester tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'semester' => 'required',
            'ket_semester' => 'required'
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $semester = $this->request->getPost('semester');
        $ket_semester = $this->request->getPost('ket_semester');

        $existingData = $model->where('semester', $semester)
        ->where('ket_semester', $ket_semester)
        ->first();

        if ($existingData && $existingData['id_semester'] !== $id) {
            return redirect()->to('admin/kelola_semester')->with('error', 'Data sudah ada dalam database');
        }

        $updatedData = [
            'semester' => $semester,
            'ket_semester' => $ket_semester
        ];
        $model->update($id, $updatedData);

        return redirect()->to('admin/kelola_semester')->with('success', 'Data ket_semester berhasil diperbarui');
    }

    private function isDataChanged($newData, $existingData)
    {
        return $newData['semester'] !== $existingData['semester'] ||
        $newData['ket_semester'] !== $existingData['ket_semester'];
    }

    public function delete($id)
    {
        $semesterModel = new SemesterModel();
        $semester = $semesterModel->find($id);

        if ($semester) {
            $semesterModel->delete($id);

            session()->setFlashdata('success', 'Data semester berhasil dihapus.');
        }
        return redirect()->back();
    }
}
