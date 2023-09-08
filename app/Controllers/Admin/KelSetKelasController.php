<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelSetKelasController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => 'kelola set kelas',

        ];
        return view('pages/admin/kelola_set_kelas/index', $data);
    }
}
