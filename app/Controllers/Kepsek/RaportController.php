<?php

namespace App\Controllers\Kepsek;

use App\Controllers\BaseController;
use App\Models\RaportModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\TahunModel;
use App\Models\SemesterModel;
use Dompdf\Dompdf;

class RaportController extends BaseController
{
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

        return view('pages/kepsek/raport', $data);
    }


    public function view($id_siswa)
    {
        $raportModel = new RaportModel();
        $raport = $raportModel->where('id_siswa', $id_siswa)->findAll();

        $totalNilai = 0;
        $countNilai = 0;

        foreach ($raport as $item) {
            $totalNilai += $item['rata_rata'];
            $countNilai++;
        }

        $rataRata = $countNilai > 0 ? $totalNilai / $countNilai : 0;
        $nilaiAkhir = number_format($rataRata, 2, '.', '');

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
            'nilaiAkhir' => $nilaiAkhir,

        ];
        return view('pages/kepsek/view-raport', $data);
    }


    public function cetak($id)
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
