<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RaportModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\TahunModel;
use App\Models\SemesterModel;
use Mpdf\Mpdf;
use Dompdf\Dompdf;

class KelRaportController extends BaseController
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

    public function index()
    {
        $raportModel = new RaportModel();
        $raport = $raportModel->findAll();

        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();

        $guruModel = new GuruModel();
        $guru = $guruModel->findAll();

        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->findAll();

        $mapelModel = new MapelModel();
        $mapel = $mapelModel->findAll();

        $tahunModel = new TahunModel();
        $tahun = $tahunModel->findAll();

        $semesterModel = new SemesterModel();
        $semester = $semesterModel->findAll();

        $data = [
            'title' => 'Kelola Raport',
            'active' => 'raport',
            'raport' => $raport,
            'kelas' => $kelas,
            'guru' => $guru,
            'siswa' => $siswa,
            'mapel' => $mapel,
            'tahun' => $tahun,
            'semester' => $semester,

        ];

        return view('pages/admin/kelola_raport/index', $data);
    }

    public function new()
    {
        $raportModel = new RaportModel();
        $raport = $raportModel->findAll();

        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();

        $guruModel = new GuruModel();
        $guru = $guruModel->findAll();

        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->findAll();

        $mapelModel = new MapelModel();
        $mapel = $mapelModel->findAll();

        $tahunModel = new TahunModel();
        $tahun = $tahunModel->findAll();

        $semesterModel = new SemesterModel();
        $semester = $semesterModel->findAll();

        $data = [
            'title' => 'Tambah Nilai Siswa',
            'active' => 'raport',
            'raport' => $raport,
            'kelas' => $kelas,
            'guru' => $guru,
            'siswa' => $siswa,
            'mapel' => $mapel,
            'tahun' => $tahun,
            'semester' => $semester,

        ];

        return view('pages/admin/kelola_raport/new', $data);
    }

    public function add()
    {
        $model = new RaportModel();

        $validationRules = [
            'id_siswa.*' => 'required',
            'id_mapel.*' => 'required',
            'id_thn_ajar.*' => 'required',
            'nilai_uts.*' => 'required|numeric', 
            'nilai_uas.*' => 'required|numeric',
        ];

        if (!$this->validate($validationRules)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        $formData = $this->request->getPost();

        // Melintasi data formulir dan menyimpan setiap set data secara terpisah.
        foreach ($formData['id_siswa'] as $formCount => $id_siswa) {

            $id_guru = $this->findGuruIdByMapelId($formData['id_mapel'][$formCount]);
            $id_kelas = $this->findKelasIdBySiswaId($formData['id_siswa'][$formCount]);
            $rata_rata = ($formData['nilai_uts'][$formCount] + $formData['nilai_uas'][$formCount]) / 2;

            $data = [
                'id_siswa' => $id_siswa,
                'id_guru' => $id_guru,
                'id_mapel' => $formData['id_mapel'][$formCount],
                'id_kelas' => $id_kelas,
                'id_thn_ajar' => $formData['id_thn_ajar'][$formCount],
                'nilai_uts' => $formData['nilai_uts'][$formCount],
                'nilai_uas' => $formData['nilai_uas'][$formCount],
                'rata_rata' => $rata_rata,
            ];

            $cekKesamaan = $model->where('id_siswa', $data['id_siswa'])
            ->where('id_mapel', $data['id_mapel'])
            ->countAllResults();

            if ($cekKesamaan > 0) {
                return redirect()->back()->withInput()->with('error', 'Data tersebut sudah ada.');
            }

            $model->insert($data);
        }

        return redirect()->to('admin/kelola_raport/new')->with('success', 'Data berhasil ditambahkan.');
    }

    public function view($id_siswa)
    {
        $raportModel = new RaportModel();
        $raport = $raportModel->where('id_siswa', $id_siswa)->findAll();

        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();

        $guruModel = new GuruModel();
        $guru = $guruModel->findAll();

        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($id_siswa);

        $mapelModel = new MapelModel();
        $mapel = $mapelModel->findAll();

        $tahunModel = new TahunModel();
        $tahun = $tahunModel->findAll();

        $semesterModel = new SemesterModel();
        $semester = $semesterModel->findAll();

        $data = [
            'title' => 'Tambah Nilai Siswa',
            'active' => 'raport',
            'raport' => $raport,
            'kelas' => $kelas,
            'guru' => $guru,
            'siswa' => $siswa,
            'mapel' => $mapel,
            'tahun' => $tahun,
            'semester' => $semester,
            'raportSiswa' => $id_siswa,

        ];
        return view('pages/admin/kelola_raport/edit', $data);
    }

    public function delete($id)
    {
        $raportModel = new RaportModel();
        $raport = $raportModel->find($id);

        if ($raport) {
            $raportModel->delete($id);

            session()->setFlashdata('success', 'Data berhasil dihapus.');
        }
        return redirect()->back();
    }

    public function pdf()
    {
        $raportModel = new RaportModel();

        $laporan = $raportModel->select('tb_raport.*, tb_siswa.nama_siswa, tb_kelas.jurusan, tb_kelas.kelas, tb_kelas.tingkat, tb_mapel.mata_pelajaran, tb_tahun_ajar.tahun, tb_guru.nama_guru')
        ->join('tb_siswa', 'tb_siswa.id_siswa = tb_raport.id_siswa', 'left')
        ->join('tb_kelas', 'tb_kelas.id_kelas = tb_raport.id_kelas', 'left')
        ->join('tb_mapel', 'tb_mapel.id_mapel = tb_raport.id_mapel', 'left')
        ->join('tb_tahun_ajar', 'tb_tahun_ajar.id_thn_ajar = tb_raport.id_thn_ajar', 'left')
        ->join('tb_guru', 'tb_guru.id_guru = tb_raport.id_guru', 'left')
        ->findAll();

    // ambil file view ke sebuah variable
        $view = view('pages/admin/kelola_raport/cetak-pdf', ['laporan' => $laporan]);

    // bikin instance Dompdf anyar
        $dompdf = new Dompdf();

    // Atur konfigurasi Dompdf
        $options = new \Dompdf\Options();
        $options->set('isPhpEnabled', true); 
        $options->set('isHtml5ParserEnabled', true); 
        $options->set('isRemoteEnabled', true); 
        $dompdf->setOptions($options);

    // atur konten HTML ambiran muncul ning file PDF
        $dompdf->loadHtml($view);

    // atur ukuran kertas
        $dompdf->setPaper('A4', 'landscape');

    // dirender dulu PDF nya
        $dompdf->render();

    // nah toli ngasili isi PDF
        $pdfContent = $dompdf->output();

    // atur nama file PDF pas di download
        $filename = 'Laporan-Raport_' . date('d-m-Y') . '.pdf';

    // bikin objek respon
        $response = service('response');

    // atur tipe kontene maning karo header ambir respons
        $response->setContentType('application/pdf');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

    // atur isi pdf sebagai body respon, ambil rata
        $response->setBody($pdfContent);

    // respone di kembalikan
        return $response;
    }

}
