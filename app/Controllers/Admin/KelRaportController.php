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

    public function edit()
    {
        $data = [
            'title' => 'Kelola Raport',
            'active' => 'raport',

        ];
        return view('pages/admin/kelola_raport/edit', $data);
    }

    public function pdfMPDF()
    {
    // Ambil data laporan dari sumber data Anda (misalnya, dari model)
        $raportModel = new RaportModel();
    $laporan = $raportModel->getLaporanData(); // Perhatikan perubahan di sini

    $data = [
        'title' => 'Judul Dokumen PDF',
        'laporan' => $laporan, // Mengirimkan data laporan ke view
    ];

    $html = view('pages/admin/kelola_raport/cetak-pdf', $data);

    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);

    // Hasilkan PDF
    $pdfData = $mpdf->Output('', 'S');

    // Simpan atau kirimkan PDF ke browser
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="nama_file.pdf"');
    header('Content-Length: ' . strlen($pdfData));
    echo $pdfData;
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
