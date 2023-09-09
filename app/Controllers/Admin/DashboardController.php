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
