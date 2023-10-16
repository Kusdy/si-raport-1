<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KdModel;
use App\Models\MapelModel;
use App\Models\KelasModel;

class SetKdController extends BaseController
{
    public function index()
    {
        $kd = new KdModel();
        $dataKd = $kd->findAll();

        $mapel = new MapelModel();
        $dataMapel = $mapel->findAll();

        foreach ($dataKd as &$item) {
            $mapelRelasi = $mapel->find($item['id_mapel']);
            if ($mapelRelasi) {
                $item['mata_pelajaran'] = $mapelRelasi['mata_pelajaran'];
                $item['id_kelas'] = $mapelRelasi['id_kelas'];
            } else {
                $item['mata_pelajaran'] = 'Tidak Diketahui';
                $item['id_kelas'] = 'Tidak Diketahui';
            }
        }

        $data = [
            'active' => 'kd',
            'title' => 'Kelola KD',
            'dataKd' => $dataKd,
            'dataMapel' => $dataMapel,
        ];
        return view('pages/admin/kelola_kd/index', $data);
    }

    public function new()
    {
        $mapel = new MapelModel();
        $dataMapel = $mapel->findAll();

        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();

        $data = [
            'active' => 'kd',
            'title' => 'Tambah KD',
            'dataMapel' => $dataMapel,
            'kelas' => $kelas,
        ];

        return view('pages/admin/kelola_kd/new', $data);
    }

    public function add()
    {
        $mapelModel = new MapelModel();
        $model = new KdModel();

        $validationRules = [
            'id_mapel.*' => 'required',
            'indikator_kd.*' => 'required',
            'deskripsi_kd.*' => 'required',
            'materi_pembelajaran.*' => 'required',
            'penilaian.*' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        $formData = $this->request->getPost();

        // Melintasi data formulir dan menyimpan setiap set data secara terpisah.
        foreach ($formData['id_mapel'] as $formCount => $id_mapel) {
            $data = [
                'id_mapel' => $id_mapel,
                'indikator_kd' => $formData['indikator_kd'][$formCount],
                'deskripsi_kd' => $formData['deskripsi_kd'][$formCount],
                'materi_pembelajaran' => $formData['materi_pembelajaran'][$formCount],
                'penilaian' => $formData['penilaian'][$formCount],
            ];

            $cekKesamaan = $model->where('id_mapel', $data['id_mapel'])
            ->where('indikator_kd', $data['indikator_kd'])
            ->countAllResults();

            if ($cekKesamaan > 0) {
                return redirect()->to('admin/kelola_kd/new')->withInput()->with('error', 'Data tersebut sudah ada dan tidak boleh sama.');
            }

            $model->insert($data);
        }

        return redirect()->to('admin/kelola_kd')->with('success', 'Data kompetensi dasar berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = new KdModel();
        
        $validationRules = [
            'id_mapel' => 'required',
            'indikator_kd' => 'required',
            'deskripsi_kd' => 'required',
            'materi_pembelajaran' => 'required',
            'penilaian' => 'required',
        ];

    // Validasi data
        if (!$this->validate($validationRules)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

    // Ambil data dari form
        $id_mapel = $this->request->getPost('id_mapel');
        $indikator_kd = $this->request->getPost('indikator_kd');
        $deskripsi_kd = $this->request->getPost('deskripsi_kd');
        $materi_pembelajaran = $this->request->getPost('materi_pembelajaran');
        $penilaian = $this->request->getPost('penilaian');

    // Data yang akan diperbarui
        $data = [
            'id_mapel' => $id_mapel,
            'indikator_kd' => $indikator_kd,
            'deskripsi_kd' => $deskripsi_kd,
            'materi_pembelajaran' => $materi_pembelajaran,
            'penilaian' => $penilaian,
        ];

    // Lakukan query update
        $result = $model->update($id, $data);

        if (!$result) {
            return redirect()->to('admin/kelola_kd')->withInput()->with('error', 'Gagal memperbarui data.');
        }

        return redirect()->to('admin/kelola_kd')->with('success', 'Data kompetensi dasar berhasil diperbarui.');
    }

    public function delete($id)
    {
        $kdModel = new KdModel();
        $kd = $kdModel->find($id);

        if ($kd) {
            $kdModel->delete($id);

            session()->setFlashdata('success', 'Data KD berhasil dihapus.');
        }
        return redirect()->back();
    }
}
