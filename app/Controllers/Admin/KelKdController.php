<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class KelKdController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Data User',
            'active' => 'kelola kd',

        ];
        return view('pages/admin/kelola_kd/index', $data);
    }
}
