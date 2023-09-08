<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $dataUser = $model->findAll();
        $data = [
            'title' => 'Data User',
            'active' => 'Data Pengguna',
            'dataUser' => $dataUser
        ];
        return view('pages/admin/data_pengguna/index', $data);
    }
}
