<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelSiswaController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => 'kelola siswa',

        ];
        return view('pages/admin/kelola_siswa/index', $data);
    }
}
