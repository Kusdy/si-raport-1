<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\KelasModel;

class KelasController extends BaseController
{
    public function index()
    {
        $model = new KelasModel();
        $kelas = $model->findAll();

        if ($this->request->getMethod() === 'post') {
            return redirect()->to('admin/search');
        }

        $data = [
            'title' => 'Data Kelas',
            'kelas' => $kelas
        ];

        $data['active'] = 'kelas';
        return view('pages/guru/kelas/index', $data);
    }
}
