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

    public function update($idSiswa)
    {
        $idMapel = $this->request->getPost('id_mapel');
        $idThnAjar = $this->request->getPost('id_thn_ajar');
        $nilaiUTS = $this->request->getPost('nilai_uts');
        $nilaiUAS = $this->request->getPost('nilai_uas');

        $raportModel = new RaportModel();

        foreach ($idMapel as $key => $value) {
            $data = [
                'id_siswa' => $idSiswa,
                'id_mapel' => $idMapel[$key],
                'id_thn_ajar' => $idThnAjar[$key],
                'nilai_uts' => $nilaiUTS[$key],
                'nilai_uas' => $nilaiUAS[$key],
                'rata_rata' => ($nilaiUTS[$key] + $nilaiUAS[$key]) / 2,
            ];

            $existingRaport = $raportModel->where([
                'id_siswa' => $idSiswa,
                'id_mapel' => $idMapel[$key],
                'id_thn_ajar' => $idThnAjar[$key],
            ])->first();

            if ($existingRaport) {
                $raportModel->update($existingRaport['id_raport'], $data);
            } 
        }

        return redirect()->to(base_url('admin/kelola_raport'))->with('success', 'Nilai raport berhasil diperbarui.');
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

    public function pdf($id)
    {
        $raportModel = new RaportModel();
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($id);

        if ($siswa) {
            $idSiswa = $siswa['id_siswa'];

            $biodata = $siswaModel->select('tb_siswa.*, tb_siswa.nama_siswa, tb_siswa.id_kelas, tb_siswa.tgl_lahir, tb_siswa.nis, tb_siswa.nama_ibu, tb_siswa.email, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'inner')
            ->where('tb_siswa.id_siswa', $idSiswa)
            ->findAll();

            $laporanRaport = $raportModel->select('tb_raport.*, tb_siswa.nama_siswa, tb_siswa.id_kelas, tb_siswa.tgl_lahir, tb_siswa.nis, tb_siswa.nama_ibu, tb_siswa.email, tb_kelas.tingkat, tb_kelas.kelas, tb_kelas.jurusan, tb_mapel.mata_pelajaran')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_raport.id_siswa', 'left')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'inner')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_raport.id_mapel', 'left')
            ->where('tb_raport.id_siswa', $idSiswa)
            ->findAll();

            $nomorSurat = $this->isiNomorSurat();
            $totalRataRata = 0;
            $jumlahData = count($laporanRaport);

            foreach ($laporanRaport as $raport) {
                $totalRataRata += $raport['rata_rata'];
            }

            $rataRata = $jumlahData > 0 ? $totalRataRata / $jumlahData : 0;
            $rataRataNilai = number_format($rataRata, 2, '.', '');

            $view = view('pages/admin/kelola_raport/cetak-pdf', [
                'biodata' => $biodata,
                'nomorSurat' => $nomorSurat,
                'laporanRaport' => $laporanRaport,
                'rataRata' => $rataRataNilai
            ]);

            $dompdf = new Dompdf();
            $options = new \Dompdf\Options();
            $options->set('isPhpEnabled', true); 
            $options->set('isHtml5ParserEnabled', true); 
            $options->set('isRemoteEnabled', true); 
            $dompdf->setOptions($options);
            setlocale(LC_TIME, 'id_ID');

            $dompdf->loadHtml($view);

            $dompdf->setPaper('F4', 'portrait');

            $dompdf->render();

            $pdfContent = $dompdf->output();

            $filename = 'Data Raport-' . date('d-m-Y-H-i-s') . '.pdf';

            $response = service('response');

            $response->setContentType('application/pdf');
            $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

            $response->setBody($pdfContent);

            return $response;
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    private function isiNomorSurat() {
        $session = session();

        if (!$session->has('nomor_urut')) {
            $session->set('nomor_urut', 1);
        }

        $nomorUrut = $session->get('nomor_urut');
        $bulanRomawi = $this->getBulanRomawi();
        $tahun = date('Y');

        $nomorSurat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT) . "/SMK/SL-KDWNG/CRBN/" . $bulanRomawi . "/" . $tahun;

        $session->set('nomor_urut', $nomorUrut + 1);

        return $nomorSurat;
    }

    private function getBulanRomawi() {
        $bulanIndex = intval(date('m')) - 1;
        $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $romawi[$bulanIndex];
    }
}
