<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SemesterModel;
use App\Models\SiswaModel;
use App\Models\TahunModel;

class KelSiswaController extends BaseController
{
    public function index()
    {   
        $modelSiswa = new SiswaModel(); 
         $dataSiswa = $modelSiswa
            ->select('tb_siswa.*, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan, tb_tahun_ajar.tahun')
            ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
            ->join('tb_tahun_ajar', 'tb_siswa.id_tahun_ajar = tb_tahun_ajar.id_thn_ajar')
            ->findAll();

        $data = [
            'title' => 'Data Siswa',
            'active' => 'kelola siswa',
            'dataSiswa' => $dataSiswa,
        ];
        return view('pages/admin/kelola_siswa/index', $data);
    }

    public function new()
    {
        $kelasModel = new KelasModel();
        $tahunModel = new TahunModel();
        $kelasOption = $kelasModel->findAll();
        $semesterOption = $tahunModel->getSelectSemester();

        $data = [
            'title'         => 'Tambah Data Siswa',
            'active'        => 'siswa',
            'kelasOption'   => $kelasOption,
            'semesterOption'   => $semesterOption,
            // 'tahunOption'   => $tahunOption

        ];
        return view('pages/admin/kelola_siswa/tambah', $data);
    }
    public function add()
    {
        $siswaModel = new SiswaModel();

        $foto = $this->request->getFile('foto');

        // Lakukan validasi tipe file
        if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/siswa', $newName);

            $data = [
                'nama_siswa' => $this->request->getPost('nama_siswa'),
                'nis' => $this->request->getPost('nis'),
                'jk' => $this->request->getPost('jk'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'alamat' => $this->request->getPost('alamat'),
                'nama_ibu' => $this->request->getPost('nama_ibu'),
                'nama_ayah' => $this->request->getPost('nama_ayah'),
                'foto' => $newName,
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
                'id_kelas' => $this->request->getPost('id_kelas'),
                'id_tahun_ajar' => $this->request->getPost('id_tahun_ajar'),

            ];

            // Nama Siswa bli oli pada
            $existingSchool = $siswaModel->where('nama_siswa', $data['nama_siswa'])->first();
            if ($existingSchool) {
                return redirect()->to(site_url('admin/kelola_siswa'))->with('error', 'Nama Siswa sudah ada dalam database.');
            }
                // Simpan data ke database
            $siswaModel->insert($data);
        

            return redirect()->to(site_url('admin/kelola_siswa'))->with('success', 'Data Siswa berhasil ditambahkan.');
        } else {
            return redirect()->to(site_url('admin/kelola_siswa'))->with('error', 'Gagal mengunggah foto. Pastikan Anda mengunggah file gambar (JPEG atau PNG.).');
        }
        
    }

    public function edit($id)
    {
        $siswaModel = new SiswaModel();
        $kelasModel = new KelasModel();
        $tahunModel = new TahunModel();
        $kelasOption = $kelasModel->findAll();
        $tahunOption = $tahunModel->findAll();
        $semesterOption = $tahunModel->getSelectSemester();

        $data = [
            'title'     => 'Edit Data Siswa',
            'active'    => 'siswa',
            'siswa'     => $siswaModel->find($id),
            'kelasOption'   => $kelasOption,
            'semesterOption'   => $semesterOption
        ];
        return view('pages/admin/kelola_siswa/edit', $data);
    }

    public function update($id)
    {
        $siswaModel = new SiswaModel();

        $siswa = $siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to(site_url('admin/kelola_siswa'))->with('error', 'Data Siswa tidak ditemukan.');
        }

        // Mengambil foto yang diunggah
        $foto = $this->request->getFile('foto');

        // Lakukan validasi tipe file dan perbarui nama file jika diunggah
        if ($foto->isValid() && !$foto->hasMoved() && in_array($foto->getClientMimeType(), ['image/jpeg', 'image/png'])) {
            // Hapus foto lama jika ada
            if (!empty($siswa['foto'])) {
                unlink('uploads/siswa/' . $siswa['foto']);
            }

            $newName = $foto->getRandomName();
            $foto->move('uploads/siswa', $newName);
            $data['foto'] = $newName;
        }

        // Update data ke database
        $data['nama_siswa'] = $this->request->getPost('nama_siswa');
        $data['nis'] = $this->request->getPost('nis');
        $data['jk'] = $this->request->getPost('jk');
        $data['tgl_lahir'] = $this->request->getPost('tgl_lahir');
        $data['alamat'] = $this->request->getPost('alamat');
        $data['nama_ibu'] = $this->request->getPost('nama_ibu');
        $data['nama_ayah'] = $this->request->getPost('nama_ayah');
        $data['no_hp'] = $this->request->getPost('no_hp');
        $data['email'] = $this->request->getPost('email');
        $data['id_kelas'] = $this->request->getPost('id_kelas');
        $data['id_tahun_ajar'] = $this->request->getPost('id_tahun_ajar');

        // Validasi nama siswa agar tidak sama dengan data lain
        $existingSchool = $siswaModel->where('nama_siswa', $data['nama_siswa'])->where('id_siswa !=', $id)->first();
        if ($existingSchool) {
            return redirect()->to(site_url('admin/kelola_siswa'))->with('error', 'Nama Siswa sudah ada dalam database.');
        }

        // Update data ke database
        $siswaModel->update($id, $data);

        return redirect()->to(site_url('admin/kelola_siswa'))->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($id)
    {
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($id);

        if (!$siswa) {
            return redirect()->to(site_url('admin/kelola_siswa'))->with('error', 'Data siswa tidak ditemukan.');
        }

        // Hapus gambar terkait jika ada
        $fotoPath = 'uploads/siswa' . $siswa['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }

        // Hapus data dari database
        $siswaModel->delete($id);

        return redirect()->to(site_url('admin/kelola_siswa'))->with('success', 'Data siswa berhasil dihapus.');
    }
}