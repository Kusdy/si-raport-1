<!DOCTYPE html>
<html>
<head>
    <title>Raport</title>
    <style type="text/css">
        body {
            font-family: Arial;
        }

        .rangkasurat {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        .logo {
            width: 100px;
        }

        .header {
            text-align: center;
            margin-top: 15px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        .header-content {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
        }

        .tebal {
            font-weight: bold;
        }

        .garis {
            border: 2px solid #000;
        }

        .table-container {
            margin-top: 20px;
        }

        .table-bawah {
            width: 100%;
            border-collapse: collapse;
        }

        .th-bawah, .td-bawah {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .td-atas {
            padding-right: 8px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        .garis {
            border: 2px solid #000;
        }

        .kontak {
            font-size: 10px;
        }

        .nomor-surat, .tgl {
            font-size: 12px;
        }

        .nomor-surat {
            float: left;
        }

        .tgl {
            float: right;
        }

        .nomor-halaman {
            text-align: right;
            font-size: 12px;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .keterangan-kiri {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 12px;
        }

    </style>
</head>
<body>
    <div class="nomor-surat">No : 013/SMK-16-KDWNG/DK-11U/XI/2023</div>
    <div class="tgl">Tgl : <?= date('d-m-Y H:i:s') ?></div>
    <div class="rangkasurat">
        <div class="header">
            <table width="100%">
                <tr>
                    <td>
                        <img src="https://sahabatdalambelajar.files.wordpress.com/2016/11/logo-tutwuri-handayani-gambar-tutwuri-handayani-makna-tutwuri-hanayani-arti-tutwurihandayani-arti-tutwurihandayanipermen-mentri-pendidikan-dan-kebudayaan-nomor-6-tahun-2013.png?w=255&h=262" class="logo" alt="Logo">
                    </td>
                    <td class="td-atas">
                        <div style="font-size: 20px;">PEMERINTAH DAERAH PROVINSI JAWA BARAT</div>
                        <div class="tebal" style="font-size: 24px;">SEKOLAH MENENGAH KEJURUAN 16 KEDAWUNG</div>
                        <div class="tebal" style="font-size: 24px;">KABUPATEN CIREBON</div>
                        <div class="tebal">
                            <font style="font-size: 14px;">JL. Tuparev No.118 Kec. Kedawung Kab. Cirebon 45121</font>
                        </div>
                        <div class="kontak">
                            E-mail: <font style="color: blue;">smk-16-kdwng@gmail.com</font> Telp: (021) 2176263 Website: <font style="color: blue;">smk-16-kdwng.ac.id</font>
                        </div>
                    </td>
                    <td>
                        <img src="https://bapenda.jabarprov.go.id/wp-content/uploads/2017/05/Logo-propinsi-jawa-barat.png" class="logo" alt="Logo">
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>
        <div class="header-content">
            <h3>Data Nilai Siswa</h3>
        </div>
        <div class="table-container">
            <table class="table-bawah">
                <thead>
                    <tr>
                        <th class="th-bawah">No</th>
                        <th class="th-bawah">Siswa</th>
                        <th class="th-bawah">Guru</th>
                        <th class="th-bawah">Kelas</th>
                        <th class="th-bawah">Mapel</th>
                        <th class="th-bawah">Tahun Ajar</th>
                        <th class="th-bawah">Nilai UTS</th>
                        <th class="th-bawah">Nilai UAS</th>
                        <th class="th-bawah">Rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($laporan as $item): ?>
                    <tr>
                        <td class="td-bawah"><?= $i++ ?></td>
                        <td class="td-bawah"><?= $item['nama_siswa'] ?></td>
                        <td class="td-bawah"><?= $item['nama_guru'] ?></td>
                        <td class="td-bawah"><?= $item['tingkat'] ?> <?= $item['jurusan'] ?> <?= $item['kelas'] ?></td>
                        <td class="td-bawah"><?= $item['mata_pelajaran'] ?></td>
                        <td class="td-bawah"><?= $item['tahun'] ?></td>
                        <td class="td-bawah"><?= $item['nilai_uts'] ?></td>
                        <td class="td-bawah"><?= $item['nilai_uas'] ?></td>
                        <td class="td-bawah"><?= $item['rata_rata'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="keterangan-kiri">SMK Negeri 16 Kedawung Cirebon</div>
        <div class="nomor-halaman">Halaman: 1</div>
    </div>
</body>
</html>
