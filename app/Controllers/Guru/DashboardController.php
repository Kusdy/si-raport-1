<?php

namespace App\Controllers\Guru;

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
        return view('pages/guru/index', $data);
    }
}
