<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {

        $model = new UserModel();
        $user = $model->findAll();

        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'user' => $user,
        ];
        return view('pages/admin/index', $data);
    }
}
