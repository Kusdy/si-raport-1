<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelSetTahunController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => 'kelola raport',

        ];
        return view('pages/admin/kelola_set_tahun/index', $data);
    }
}
