<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pelanggaran Siswa</title>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
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

        .td-bawah-second {
            border: 1px solid #000;
            padding: 8px;
        }

        .td-bawah {
            border: 1px solid #000;
            padding: 8px;
            font-weight: bold;
        }

        .td-atas {
            padding-right: 8px;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
            border: 1px solid #000;
        }

        .garis {
            border: 2px solid #000;
        }

        .kontak {
            font-size: 10px;
        }

        .nomor-surat,
        .tgl {
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

        .data-table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        .data-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .data-label {
            font-weight: bold;
            text-align: left;
        }

        .data-value {
            text-align: left;
        }

        .additional-info {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="nomor-surat">No : <?= $nomorSurat; ?></div>
    <div class="tgl">Tgl : <?= date('d-m-Y H:i:s') ?></div>
    <div class="rangkasurat">
        <div class="header">
            <table width="100%">
                <tr>
                    <td>
                        <img src="https://sahabatdalambelajar.files.wordpress.com/2016/11/logo-tutwuri-handayani-gambar-tutwuri-handayani-makna-tutwuri-hanayani-arti-tutwurihandayani-arti-tutwurihandayanipermen-mentri-pendidikan-dan-kebudayaan-nomor-6-tahun-2013.png?w=255&h=262" class="logo" alt="Logo">
                    </td>
                    <td class="td-atas">
                        <div class="tebal" style="font-size: 22px;">SMK SILIWANGI KEDAWUNG</div>
                        <div class="tebal" style="font-size: 22px;">KABUPATEN CIREBON</div>
                        <div class="tebal">
                            <font style="font-size: 14px;">JL. tuparev No.118 Kec. kedawung Kab. Cirebon 45121</font>
                        </div>
                        <div class="kontak">
                            E-mail: <font style="color: blue;">smk-siliwangi-kdwng@gmail.com</font> Telp: (021) 2176263 Website: <font style="color: blue;">smk-siliwangi-kdwng.sch.id</font>
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
            <h3>Data Nilai Raport</h3>
        </div>
        <div class="table-container">
            <table class="table-bawah" style="border: 0px; font-size: 12px; width: 620px; margin: auto;">
                <tbody>
                    <?php $isFirstSiswa = true; ?>
                    <?php foreach ($biodata as $item): ?>
                        <?php if ($isFirstSiswa): ?>
                            <tr>
                                <td class="data-label">Nama</td>
                                <td class="data-value">: <?= $item['nama_siswa'] ?></td>
                                <td class="data-label">Kelas</td>
                                <td class="data-value">: <?= $item['tingkat'] ?> <?= $item['jurusan'] ?> <?= $item['kelas'] ?></td>
                                <td class="data-label">NIS</td>
                                <td class="data-value">: <?= $item['nis'] ?></td>
                            </tr>
                            <tr>
                                <td class="data-label">Tgl Lahir</td>
                                <td class="data-value">: <?= date_format(date_create($item['tgl_lahir']), 'd-m-Y') ?></td>
                                <td class="data-label">Orangtua/Wali</td>
                                <td class="data-value">: <?= $item['nama_ibu'] ?></td>
                                <td class="data-label">Email</td>
                                <td class="data-value">: <?= $item['email'] ?></td>
                            </tr>
                            <?php $isFirstSiswa = false; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table class="table-bawah" style="margin-top: 10px;">
                <thead>
                    <tr style="background-color: #f0f2f0;">
                        <th>No</th>
                        <th>Mara Pelajaran</th>
                        <th>Nilai UTS</th>
                        <th>Nilai UAS</th>
                        <th>Nilai Rata-Rata</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($laporanRaport)) : ?>
                        <tr>
                            <td colspan="5" align="center" class="td-bawah-second">-- Belum ada data raport--</td>
                        </tr>
                    <?php else : ?>
                        <?php $i = 1; ?>
                        <?php foreach ($laporanRaport as $value): ?>
                            <tr>
                                <td class="td-bawah-second" align="center"><?= $i++ ?></td>
                                <td class="td-bawah-second" align="center"><?= $value['mata_pelajaran'] ?></td>
                                <td class="td-bawah-second" align="center"><?= $value['nilai_uts'] ?></td>
                                <td class="td-bawah-second" align="center"><?= $value['nilai_uas'] ?></td>
                                <td class="td-bawah-second" align="center"><?= $value['rata_rata'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Nilai Akhir</th>
                        <th><?= $rataRata; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="additional-info">
            <p>Cirebon, <?= date('d M Y') ?></p>
            <label>Kepala Sekolah</label><br>
            <label>SMK Siliwangi Kedawung</label>
            <br><br><br><br><br><br>
            <strong style="text-decoration: underline;">Dr. Mosyahizuku, M.Cs</strong><br>
            <label>NIP: 20152676762</label>
        </div>
        <div class="keterangan-kiri">SMK Siliwangi Kedawung Cirebon</div>
        <div class="nomor-halaman">Data Raport Siswa</div>
    </div>
</body>

</html>