<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuruModel;

class KelGuruController extends BaseController
{
    public function index()
    {
        $guruModel = new GuruModel();
        $guru = $guruModel->findAll();

        $data = [
            'title'     => 'Data User',
            'active'    => 'kelola guru',
            'dataGuru'  => $guru,
        ];
        return view('pages/admin/kelola_guru/index', $data);
    }

    public function new(){

        $data = [
            'title' => 'Tambah Data Guru',
            'active' => 'guru',

        ];
        return view('pages/admin/kelola_guru/tambah', $data);
    }

    public function add()
    {
        $guruModel = new GuruModel();

        $foto = $this->request->getFile('foto');

        // Lakukan validasi tipe file
        if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/guru/', $newName);

            $data = [
                'nama_guru' => $this->request->getPost('nama_guru'),
                'nip' => $this->request->getPost('nip'),
                'jk' => $this->request->getPost('jk'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'alamat' => $this->request->getPost('alamat'),
                'foto' => $newName,
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
                'id_kelas' => $this->request->getPost('id_kelas'),
                'id_mapel' => $this->request->getPost('id_mapel'),

            ];

            // Nama guru bli oli pada
            $existingSchool = $guruModel->where('nama_guru', $data['nama_guru'])->first();
            if ($existingSchool) {
                return redirect()->to(site_url('admin/kelola_guru'))->with('error', 'Nama guru sudah ada dalam database.');
            }
                // Simpan data ke database
            $guruModel->insert($data);
        

            return redirect()->to(site_url('admin/kelola_guru'))->with('success', 'Data guru berhasil ditambahkan.');
        } else {
            return redirect()->to(site_url('admin/kelola_guru'))->with('error', 'Gagal mengunggah foto. Pastikan Anda mengunggah file gambar (JPEG atau PNG.).');
        }
        
    }

    public function edit($id)
    {
        $guruModel = new GuruModel();
        $data = [
            'title'     => 'Edit Data Guru',
            'active'    => 'guru',
            'guru'     => $guruModel->find($id),
        ];
        return view('pages/admin/kelola_guru/edit', $data);
    }

    public function update($id)
    {
        $guruModel = new GuruModel();

        $guru = $guruModel->find($id);

        if (!$guru) {
            return redirect()->to(site_url('admin/kelola_guru'))->with('error', 'Data guru tidak ditemukan.');
        }

        // Mengambil foto yang diunggah
        $foto = $this->request->getFile('foto');

        // Lakukan validasi tipe file dan perbarui nama file jika diunggah
        if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
            // Hapus foto lama jika ada
            if (!empty($guru['foto'])) {
                unlink('uploads/guru/' . $guru['foto']);
            }

            $newName = $foto->getRandomName();
            $foto->move('uploads/guru/', $newName);
            $data['foto'] = $newName;
        }

        // Update data ke database
        $data['nama_guru'] = $this->request->getPost('nama_guru');
        $data['nip'] = $this->request->getPost('nip');
        $data['jk'] = $this->request->getPost('jk');
        $data['tgl_lahir'] = $this->request->getPost('tgl_lahir');
        $data['alamat'] = $this->request->getPost('alamat');
        $data['no_hp'] = $this->request->getPost('no_hp');
        $data['email'] = $this->request->getPost('email');
        $data['id_kelas'] = $this->request->getPost('id_kelas');
        $data['id_mapel'] = $this->request->getPost('id_mapel');

        // Validasi nama guru agar tidak sama dengan data lain
        $existingSchool = $guruModel->where('nama_guru', $data['nama_guru'])->where('id_guru !=', $id)->first();
        if ($existingSchool) {
            return redirect()->to(site_url('admin/kelola_guru'))->with('error', 'Nama guru sudah ada dalam database.');
        }

        // Update data ke database
        $guruModel->update($id, $data);

        return redirect()->to(site_url('admin/kelola_guru'))->with('success', 'Data guru berhasil diperbarui.');
    }

    public function delete($id)
    {
        $guruModel = new GuruModel();
        $guru = $guruModel->find($id);

        if (!$guru) {
            return redirect()->to(site_url('admin/kelola_guru'))->with('error', 'Data guru tidak ditemukan.');
        }

        // Hapus gambar terkait jika ada
        $fotoPath = 'uploads/guru/' . $guru['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }

        // Hapus data dari database
        $guruModel->delete($id);

        return redirect()->to(site_url('admin/kelola_guru'))->with('success', 'Data guru berhasil dihapus.');
    }
}