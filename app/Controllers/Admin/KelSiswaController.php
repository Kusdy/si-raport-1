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

    public function edit()
    {
        $data = [
            'title' => 'Data User',
            'active' => 'siswa',

        ];
        return view('pages/admin/kelola_siswa/edit', $data);
    }
}
