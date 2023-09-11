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

        if ($this->request->getMethod() === 'post') {
            return redirect()->to('admin/search');
        }

        $data = [
            'title' => 'Data Pengguna',
            'active' => 'pengguna',
            'dataUser' => $dataUser
        ];
        return view('pages/admin/data_pengguna/index', $data);
    }

    public function new()
    {
        $model = new UserModel();
        $dataUser = $model->findAll();
        $data = [
            'title' => 'Form Tambah Pengguna',
            'dataUser' => $dataUser
        ];
        $data['active'] = 'pengguna';
        return view('pages/admin/data_pengguna/tambah', $data);
    }

    public function add()
    {
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userModel = new UserModel();

        $userData = [
            'nama' => $nama,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role
        ];

        $cekEmail = $userModel->where('email', $userData['email'])->first();
        if ($cekEmail) {
            return redirect()->back()->with('error', 'Email sudah ada dalam database.');
        }

        $userModel->insert($userData);
        session()->setFlashdata('success', 'Data Pengguna berhasil ditambahkan.');
        return redirect()->to('admin/data-pengguna');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $data['user'] = $user;
            $data['title'] = 'Edit Pengguna';
            $data['active'] = 'pengguna';
            return view('pages/admin/data_pengguna/edit', $data);
        } else {
            return redirect()->back();
        }
    }

    public function update($id)
    {
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $userModel = new UserModel();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userData = [
            'nama' => $nama,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role,
        ];

        $cekEmail = $userModel->where('email', $userData['email'])->first();
        if ($cekEmail && $cekEmail['id_user'] !== $id) {
            return redirect()->back()->with('error', 'Email sudah ada dalam database.');
        }

        $userModel->update($id, $userData);
        session()->setFlashdata('success', 'Data pengguna berhasil diperbaharui.');
        return redirect()->to('admin/data-pengguna');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if ($user) {
            $userModel->delete($id);

            session()->setFlashdata('success', 'Data pengguna berhasil dihapus.');
        }
        return redirect()->back();
    }
}
