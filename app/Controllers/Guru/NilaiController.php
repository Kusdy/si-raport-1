<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\RaportModel;
use App\Models\SemesterModel;
use App\Models\SiswaModel;
use App\Models\TahunModel;
use CodeIgniter\View\View;

class NilaiController extends BaseController
{
    public function findGuruIdByMapelId($id_mapel)
    {
        $mapel = new MapelModel();
        $guruId = $mapel->where('id_mapel', $id_mapel)->first();

        if ($guruId) {
            return $guruId['id_guru'];
        }

        return null; 
    }

    public function findKelasIdBySiswaId($id_siswa)
    {
        $siswa = new SiswaModel();
        $siswaId = $siswa->where('id_siswa', $id_siswa)->first();

        if ($siswaId) {
            return $siswaId['id_kelas'];
        }

        return null; 
    }

    public function editRaport($id_raport)
    {
        // Panggil fungsi edit dengan menyertakan id_raport
        $this->update($id_raport);
    }

    public function test()
    {
        $raportModel = new RaportModel;

        $raport = $raportModel->getRaportData();

        $data = [
            'raport' => $raport,
        ];

        return view('pages/guru/nilai/index', $data);
    }
    public function index()
    {
        $kelasModel = new KelasModel();
        $siswaModel = new SiswaModel();
        $mapelModel = new MapelModel();
        $guruModel = new GuruModel();
        $raportModel = new RaportModel();
        $tahunModel = new TahunModel();
        $semesterModel = new SemesterModel();

        $semester = $semesterModel->findAll();
        $tahunAjar = $tahunModel->findAll();
        $guru = $guruModel->findAll();
        $mapel = $mapelModel->findAll();
        $kelasOption = $kelasModel->findAll();

        $selectedKelas = 'Semua Kelas';
        $siswa = $siswaModel->select('tb_siswa.*, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan, tb_mapel.mata_pelajaran, tb_raport.nilai_uts, tb_raport.nilai_uas, tb_raport.id_raport, tb_raport.id_mapel, tb_guru.nama_guru as nama_guru, tb_tahun_ajar.tahun, tb_tahun_ajar.id_thn_ajar') // tambahkan id_thn_ajar ke dalam select
                ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
                ->join('tb_raport', 'tb_siswa.id_siswa = tb_raport.id_siswa', 'left')
                ->join('tb_guru', 'tb_raport.id_guru = tb_guru.id_guru', 'left')
                ->join('tb_mapel', 'tb_raport.id_mapel = tb_mapel.id_mapel', 'left')
                ->join('tb_tahun_ajar', 'tb_raport.id_thn_ajar = tb_tahun_ajar.id_thn_ajar', 'left')
                ->findAll();

        // Get the available semesters for the dropdown
        $semesterOptions = $tahunModel->getSelectSemester();

        $data = [
            'title' => 'Data nilai',
            'kelasOption' => $kelasOption,
            'siswa' => $siswa,
            'selectedKelas' => $selectedKelas,
            'mapel' => $mapel,
            'guru' => $guru,
            'semester' => $semester,
            'tahunAjar' => $tahunAjar,
            'semesterOptions' => $semesterOptions,
            'raport' => $raportModel->findAll(),
        ];

        $data['active'] = 'Nilai';
        return view('pages/guru/nilai/index', $data);
    }

    public function search()
    {
        $selectedKelas = $this->request->getPost('kelas');
        $selectedSemester = $this->request->getPost('semester');

        $kelasModel = new KelasModel();
        $siswaModel = new SiswaModel();
        $mapelModel = new MapelModel();
        $guruModel = new GuruModel();
        $raportModel = new RaportModel();
        $tahunModel = new TahunModel();
        $semesterModel = new SemesterModel();

        $semester = $semesterModel->findAll();
        $tahunAjar = $tahunModel->findAll();
        $guru = $guruModel->findAll();
        $mapel = $mapelModel->findAll();
        $kelasOption = $kelasModel->findAll();

        // Dapatkan semester yang tersedia untuk dropdown
        $semesterOptions = $tahunModel->getSelectSemester();

        $siswa = [];

        if ($selectedKelas === 'Semua Kelas') {
            // Jika "Semua Kelas" dipilih, ambil semua data siswa
            $siswa = $siswaModel->select('tb_siswa.*, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan, tb_mapel.mata_pelajaran, tb_raport.nilai_uts, tb_raport.nilai_uas, tb_raport.id_raport, tb_raport.id_mapel, tb_guru.nama_guru as nama_guru, tb_tahun_ajar.tahun, tb_tahun_ajar.id_thn_ajar') // tambahkan id_thn_ajar ke dalam select
                ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
                ->join('tb_raport', 'tb_siswa.id_siswa = tb_raport.id_siswa', 'left')
                ->join('tb_guru', 'tb_raport.id_guru = tb_guru.id_guru', 'left')
                ->join('tb_mapel', 'tb_raport.id_mapel = tb_mapel.id_mapel', 'left')
                ->join('tb_tahun_ajar', 'tb_raport.id_thn_ajar = tb_tahun_ajar.id_thn_ajar', 'left')
                ->findAll();
        } else {
            // Jika kelas tertentu dipilih, ambil hanya data siswa dari kelas tersebut
            $siswa = $siswaModel->select('tb_siswa.*, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan, tb_mapel.mata_pelajaran, tb_raport.nilai_uts, tb_raport.nilai_uas, tb_raport.id_raport, tb_raport.id_mapel, tb_guru.nama_guru as nama_guru, tb_tahun_ajar.tahun, tb_tahun_ajar.id_thn_ajar')
                ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
                ->join('tb_raport', 'tb_siswa.id_siswa = tb_raport.id_siswa', 'left')
                ->join('tb_guru', 'tb_raport.id_guru = tb_guru.id_guru', 'left')
                ->join('tb_mapel', 'tb_raport.id_mapel = tb_mapel.id_mapel', 'left')
                ->join('tb_tahun_ajar', 'tb_raport.id_thn_ajar = tb_tahun_ajar.id_thn_ajar', 'left')
                ->where('tb_kelas.kelas', $selectedKelas)
                ->findAll();
        }

        foreach ($siswa as &$item) {
            $existingRecord = $raportModel->where('id_siswa', $item['id_siswa'])
                ->where('id_mapel', $item['id_mapel'])
                ->first();

            $item['existingRecord'] = $existingRecord;
        }

        // Data yang akan dikirimkan ke halaman tampilan
        $data = [
            'title' => 'Data nilai',
            'kelasOption' => $kelasOption,
            'siswa' => $siswa,
            'selectedKelas' => $selectedKelas,
            'mapel' => $mapel,
            'guru' => $guru,
            'semester' => $semester,
            'tahunAjar' => $tahunAjar,
            'semesterOptions' => $semesterOptions,
            'selectedSemester' => $selectedSemester,
            'raport' => $raportModel->findAll(),
        ];

        $data['active'] = 'Nilai';
        return view('pages/guru/nilai/new', $data);
    }

    public function new()
    {
        $kelasModel = new KelasModel();
        $siswaModel = new SiswaModel();
        $mapelModel = new MapelModel();
        $raportModel = new RaportModel();
        $tahunModel = new TahunModel();

        $tahunAjar = $tahunModel->findAll();
        $mapel = $mapelModel->findAll();
        $kelasOption = $kelasModel->findAll();

        $selectedKelas = 'Semua Kelas';

        // Get the available semesters for the dropdown
        $semesterOptions = $tahunModel->getSelectSemester();

        $data = [
            'title' => 'Data nilai',
            'kelasOption' => $kelasOption,
            'siswa' => [],
            'selectedKelas' => $selectedKelas,
            'mapel' => $mapel,
            'tahunAjar' => $tahunAjar,
            'semesterOptions' => $semesterOptions,
            'raport' => $raportModel->findAll(),
        ];

        $data['active'] = 'Nilai';
        return view('pages/guru/nilai/new', $data);
    }
    
    public function add()
    {
        $model = new RaportModel();

        // Atur aturan validasi
        $validationRules = [
            'id_siswa.*' => 'required',
            'id_mapel.*' => 'required',
            'tahunAjar.*' => 'required',
            'nilai_uts.*' => 'required|numeric', 
            'nilai_uas.*' => 'required|numeric',
        ];

        // Validasi data form
        if (!$this->validate($validationRules)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        $formData = $this->request->getPost();

        // Gunakan transaksi database
        $model->transBegin();

        try {
            // Melintasi data formulir dan menyimpan setiap set data secara terpisah.
            foreach ($formData['id_siswa'] as $formCount => $id_siswa) {
                // Dapatkan id guru dan id kelas
                $id_guru = $this->findGuruIdByMapelId($formData['id_mapel'][$formCount]);
                $id_kelas = $this->findKelasIdBySiswaId($formData['id_siswa'][$formCount]);

                // Hitung rata-rata
                $rata_rata = ($formData['nilai_uts'][$formCount] + $formData['nilai_uas'][$formCount]) / 2;

                // Bentuk data untuk disimpan
                $data = [
                    'id_siswa' => $id_siswa,
                    'id_guru' => $id_guru,
                    'id_mapel' => $formData['id_mapel'][$formCount],
                    'id_kelas' => $id_kelas,
                    'id_thn_ajar' => $formData['tahunAjar'][$formCount],
                    'nilai_uts' => $formData['nilai_uts'][$formCount],
                    'nilai_uas' => $formData['nilai_uas'][$formCount],
                    'rata_rata' => $rata_rata,
                ];

                // Periksa kesamaan data sebelum menyimpan
                $existingRecord = $model->where('id_siswa', $data['id_siswa'])
                    ->where('id_mapel', $data['id_mapel'])
                    ->first();

                if ($existingRecord) {
                    // Jika data sudah ada, perbarui rekaman
                    $model->update($existingRecord['id_raport'], $data);
                } else {
                    // Jika data belum ada, sisipkan rekaman baru
                    $model->insert($data);
                }
            }

            // Commit transaksi jika semua operasi berhasil
            $model->transCommit();

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $model->transRollback();
            log_message('error', 'Error in adding/updating data: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan/mengupdate data.');
        }
    }

    public function update($id_raport)
    {
        $model = new RaportModel();

        // Atur aturan validasi
        $validationRules = [
            'id_siswa.*' => 'required',
            'id_mapel.*' => 'required',
            'tahunAjar.*' => 'required',
            'nilai_uts.*' => 'required|numeric', 
            'nilai_uas.*' => 'required|numeric',
        ];

        // Validasi data form
        if (!$this->validate($validationRules)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        $formData = $this->request->getPost();

        // Gunakan transaksi database
        $model->transBegin();

        try {
            foreach ($formData['id_siswa'] as $formCount => $id_siswa) {
                $id_guru = $this->findGuruIdByMapelId($formData['id_mapel'][$formCount]);
                $id_kelas = $this->findKelasIdBySiswaId($formData['id_siswa'][$formCount]);

                $rata_rata = ($formData['nilai_uts'][$formCount] + $formData['nilai_uas'][$formCount]) / 2;

                $data = [
                    'id_siswa' => $id_siswa,
                    'id_guru' => $id_guru,
                    'id_mapel' => $formData['id_mapel'][$formCount],
                    'id_kelas' => $id_kelas,
                    'id_thn_ajar' => $formData['tahunAjar'][$formCount],
                    'nilai_uts' => $formData['nilai_uts'][$formCount],
                    'nilai_uas' => $formData['nilai_uas'][$formCount],
                    'rata_rata' => $rata_rata,
                ];

                // Perbarui rekaman berdasarkan id_raport
                $model->update($id_raport, $data);
            }

            // Commit transaksi jika semua operasi berhasil
            $model->transCommit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $model->transRollback();
            log_message('error', 'Error in updating data: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function delete($id_raport)
    {
        $model = new RaportModel();

        // Gunakan transaksi database
        $model->transBegin();

        try {
            // Hapus rekaman berdasarkan id_raport
            $model->delete($id_raport);

            // Commit transaksi jika operasi berhasil
            $model->transCommit();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $model->transRollback();
            log_message('error', 'Error in deleting data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }


}