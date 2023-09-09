<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelGuruController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => 'guru',

        ];
        return view('pages/admin/kelola_guru/index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Data User',
            'active' => 'guru',

        ];
        return view('pages/admin/kelola_guru/edit', $data);
    }
}
