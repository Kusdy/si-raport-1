<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelMapelController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => 'kelola mapel',

        ];
        return view('pages/admin/kelola_mapel/index', $data);
    }
}
