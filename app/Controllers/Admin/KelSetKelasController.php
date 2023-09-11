<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelSetKelasController extends BaseController
{
    public function index()
    {
        if ($this->request->getMethod() === 'post') {
            return redirect()->to('admin/search');
        }

        $data = [
            'title' => 'Data User',
            'active' => 'kelola set kelas',

        ];
        return view('pages/admin/kelola_set_kelas/index', $data);
    }
}
