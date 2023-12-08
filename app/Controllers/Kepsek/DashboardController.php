<?php

namespace App\Controllers\Kepsek;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\RaportModel;

class DashboardController extends BaseController
{
    public function index()
    {

        $model = new UserModel();
        $modelSiswa = new SiswaModel();
        $modelRaport = new RaportModel();
        $user = $model->findAll();
        $siswa = $model->findAll();
        $raport = $model->findAll();

        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'user' => $user,
            'siswa' => $siswa,
            'raport' => $raport,
        ];

        return view('pages/kepsek/index', $data);
    }
}
