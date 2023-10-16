<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Home /</span> <?= $title; ?>
        </h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="card-header">Data Raport</h5>
                </div>
                <div class="col-md-4 text-end">
                    <div class="btn-group mt-3" style="margin-right: 20px;">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Cetak
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('admin/kelola_raport/cetak-pdf') ?>">PDF</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Nama Guru</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Tahun Ajar</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Rata-rata</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach ($raport as $item): ?>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td><?= $i++ ?></td>
                                <?php foreach ($siswa as $sis): ?>
                                    <?php if ($sis['id_siswa'] == $item['id_siswa']): ?>
                                        <td><?= $sis['nama_siswa'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($guru as $gur): ?>
                                    <?php if ($gur['id_guru'] == $item['id_guru']): ?>
                                        <td><?= $gur['nama_guru'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($mapel as $map): ?>
                                    <?php if ($map['id_mapel'] == $item['id_mapel']): ?>
                                        <td><?= $map['mata_pelajaran'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($kelas as $kel): ?>
                                    <?php if ($kel['id_kelas'] == $item['id_kelas']): ?>
                                        <td><?= $kel['tingkat'] ?> <?= $kel['jurusan'] ?> <?= $kel['kelas'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($tahun as $tah): ?>
                                    <?php if ($tah['id_thn_ajar'] == $item['id_thn_ajar']): ?>
                                        <td><?= $tah['tahun'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <td><?= $item['nilai_uts'] ?></td>
                                <td><?= $item['nilai_uas'] ?></td>
                                <td><?= $item['rata_rata'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('admin/kelola_raport/edit') ?>"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>