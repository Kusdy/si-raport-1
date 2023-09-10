<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelRaportController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => ' raport',

        ];
        return view('pages/admin/kelola_raport/index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Data User',
            'active' => 'raport',

        ];
        return view('pages/admin/kelola_raport/edit', $data);
    }
}
