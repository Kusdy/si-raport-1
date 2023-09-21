<?php

namespace App\Controllers\Wakel;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\KdModel;
use App\Models\UserModel;
use App\Models\MapelModel;

class InputNilaiController extends BaseController
{
    public function index()
    {

        $model = new UserModel();
        $user = $model->findAll();

        $data = [
            'title' => 'nilai',
            'active' => 'nilai',
            'user' => $user,
        ];
        return view('pages/wakel/input_nilai/index', $data);
    }

    public function tambah()
    {
        $mapel = new MapelModel();
        $guru   = new GuruModel();
        $dataMapel = $mapel->findAll();
        $dataGuru   = $guru->findAll();

        $data = [
            'active' => 'kd',
            'title' => 'Tambah KD',
            'dataMapel' => $dataMapel,
            'dataGuru' => $dataGuru,
        ];
        return view('pages/wakel/input_nilai/tambah', $data);
    }

    public function edit()
    {
        $mapel  = new MapelModel();
        $guru   = new GuruModel();
        $kd     = new KdModel();
        $dataMapel  = $mapel->findAll();
        $dataGuru   = $guru->findAll();
        $dataKd     = $kd->findAll();

        $data = [
            'active'    => 'kd',
            'title'     => 'Tambah KD',
            'dataMapel' => $dataMapel,
            'dataGuru'  => $dataGuru,
            'dataKd'    => $dataKd,
        ];
        return view('pages/wakel/input_nilai/edit', $data);
    }
}
