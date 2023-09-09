<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SemesterModel;
use App\Models\TahunModel;

class KelSetTahunController extends BaseController
{
    public function index(): string
    {
        $model = new TahunModel();
        $semesterModel = new SemesterModel();
        $semesterData = $semesterModel->findAll();
        $tahun = $model->findAll();

        foreach ($tahun as &$item) {
            $semester = $semesterModel->find($item['id_semester']);
            if ($semester) {
                $item['semester'] = $semester['semester'];
                $item['ket_semester'] = $semester['ket_semester'];
            } else {
                $item['semester'] = 'Tidak Diketahui';
                $item['ket_semester'] = 'Tidak Diketahui';
            }
        }

        $data = [
            'title' => 'Data Kelas',
            'tahun' => $tahun,
            'active' => 'tahun',
            'semesterData' => $semesterData,
        ];
        return view('pages/admin/kelola_tahun_ajar/index', $data);
    }

    public function add()
    {
        $semesterModel = new SemesterModel();
        $model = new TahunModel();

        $validationRules = [
            'id_semester' => 'required',
            'tahun' => 'permit_empty',
        ];

        if (!$this->validate($validationRules)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        $tahun_awal = $this->request->getPost('tahun_awal');
        $tahun_akhir = $this->request->getPost('tahun_akhir');

        if (!empty($tahun_awal) && !empty($tahun_akhir)) {
            $data = [
                'id_semester' => $this->request->getPost('id_semester'),
                'tahun' => $tahun_awal . '/' . $tahun_akhir,
            ];
        } else {
            return redirect()->back()->withInput()->with('error', 'Tahun ajaran harus diisi.');
        }

        $cekKesamaan = $model->where('id_semester', $data['id_semester'])
        ->where('tahun', $data['tahun'])
        ->countAllResults();

        if ($cekKesamaan > 0) {
            return redirect()->to('admin/kelola_tahun_ajar')->withInput()->with('error', 'Data tersebut sudah ada.');
        }

        $model->insert($data);

        return redirect()->back()->with('success', 'Data tahun ajaran berhasil ditambahkan.');
    }

    public function update($id)
    {
        $semesterModel = new SemesterModel();
        $model = new TahunModel();

        $validationRules = [
            'id_semester' => 'required',
            'tahun_awal' => 'required',
            'tahun_akhir' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        $id_semester = $this->request->getPost('id_semester');
        $tahun_awal = $this->request->getPost('tahun_awal');
        $tahun_akhir = $this->request->getPost('tahun_akhir');

        $data = [
            'id_semester' => $id_semester,
            'tahun' => $tahun_awal . '/' . $tahun_akhir,
        ];

        $cekKesamaan = $model->where('id_thn_ajar', $id)
        ->where('id_semester', $id_semester)
        ->where('tahun', $data['tahun'])
        ->countAllResults();

        if ($cekKesamaan > 0) {
            return redirect()->to('admin/kelola_tahun_ajar')->withInput()->with('error', 'Data tersebut sudah ada.');
        }

        $model->update($id, $data);

        return redirect()->to('admin/kelola_tahun_ajar')->with('success', 'Data tahun ajaran berhasil diperbarui.');
    }

    public function delete($id)
    {
        $tahunModel = new TahunModel();
        $tahun = $tahunModel->find($id);

        if ($tahun) {
            $tahunModel->delete($id);

            session()->setFlashdata('success', 'Data tahun ajaran berhasil dihapus.');
        }
        return redirect()->back();
    }
}
