<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\SetKelasModel;
use App\Models\WaliKelasModel;


class KelSetKelasController extends BaseController
{
    public function index()
    {
        if ($this->request->getMethod() === 'post') {
            return redirect()->to('admin/search');
        }

        // form
        $waliKelasModel = new WaliKelasModel();
        $waliOption = $waliKelasModel->getWaliKelasWithGuruAndKelas(); 
        $mapelModel = new MapelModel();
        $mapelDataAll = $mapelModel->findAll(); 

        // tabel index
        $setKelasModel = new SetKelasModel();
        $setKelasData = $setKelasModel->getSetKelasWithGuruAndMapel();

        foreach ($setKelasData as &$setKelas) {
            $setKelas['mata_pelajaran'] = [];
            $idMapel = json_decode($setKelas['id_mapel']);
            if (!empty($idMapel)) {
                // Ambil data mata pelajaran sesuai dengan id_mapel
                $setKelas['mata_pelajaran'] = $mapelModel->whereIn('id_mapel', $idMapel)->findAll();
            }
        }

        $data = [
            'title' => 'Seting Kelas',
            'active' => 'set kelas',
            'waliOption' => $waliOption,
            'setKelas' => $setKelasData,
            'mapelData' => $mapelDataAll // Gunakan variabel $mapelDataAll untuk daftar semua mata pelajaran
        ];

        return view('pages/admin/kelola_set_kelas/index', $data);

    }

    public function new(){
        
        $waliKelasModel = new WaliKelasModel();
        $waliOption = $waliKelasModel->getWaliKelasWithGuruAndKelas();
        $mapelModel = new MapelModel();
        $mapelData = $mapelModel->findAll(); 

        $data = [
            'title' => 'Tambah Set Kelas',
            'active' => 'set kelas',
            'waliOption'    => $waliOption,
            'mapelData'     => $mapelData
        ];
        
        return view('pages/admin/kelola_set_kelas/tambah', $data);
    }

    public function add(){

        $model = new SetKelasModel();

        $validationRules = [
            'id_wali_kelas' => 'required',
            'id_mapel' => [
                'label' => 'Mata Pelajaran',
                'rules' => 'required|is_array',
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $waliKelas  = $this->request->getPost('id_wali_kelas');
        $Mapel      = $this->request->getPost('id_mapel');

        $data = [
            'id_wali_kelas' => $waliKelas,
            'id_mapel' => json_encode($Mapel),
        ];

        $cekKesamaan = $model->where('id_wali_kelas', $data['id_wali_kelas'])
        ->countAllResults();

         if ($model->insert($data)) {
            return redirect()->to(base_url('admin/kelola_set_kelas'))->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->to(base_url('admin/kelola_set_kelas'))->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

    }

    public function update($id)
    {
        $model = new SetKelasModel();

        $validationRules = [
            'id_wali_kelas' => 'required',
            'id_mapel' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $waliKelas = $this->request->getPost('id_wali_kelas');
        $Mapel = $this->request->getPost('id_mapel');

        $data = [
            'id_wali_kelas' => $waliKelas,
            'id_mapel' => json_encode($Mapel),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to(base_url('admin/kelola_set_kelas'))->with('success', 'Data berhasil diupdate.');
        } else {
            return redirect()->to(base_url('admin/kelola_set_kelas'))->with('error', 'Terjadi kesalahan saat mengupdate data.');
        }
    }

}