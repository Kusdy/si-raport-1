<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login Admin'
        ];
        return view('auth/login-admin', $data);
    }

    public function Login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $session = \Config\Services::session();
            $session->set('auth', true);
            $session->set('email', $email);
            $session->set('nama', $user['nama']);
            $session->set('role', $user['role']);

            switch ($user['role']) {
                case 'Admin':
                return redirect()->to('admin/dashboard');
                break;
                case 'Guru':
                return redirect()->to('guru/dashboard');
                break;
                case 'Siswa':
                return redirect()->to('siswa/dashboard');
                break;
                case 'Wali kelas':
                return redirect()->to('wakel/dashboard');
                break;
                case 'Kepala sekolah':
                return redirect()->to('kepsek/dashboard');
                break;
                default:
                // Role Ngaco
                return redirect()->to('/');
            }
        }

        $session = \Config\Services::session();
        $session->setFlashdata('error', 'Email atau Password Anda Salah');
        return view('auth/login-admin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
