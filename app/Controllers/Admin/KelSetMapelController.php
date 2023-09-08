<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelSetMapelController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => 'kelola set mapel',

        ];
        return view('pages/admin/kelola_set_mapel/index', $data);
    }
}
