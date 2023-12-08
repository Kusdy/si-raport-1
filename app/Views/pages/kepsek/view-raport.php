<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Home /</span> <?= $title; ?>
        </h4>
        <div class="card">
            <div class="row">
                <div class="col-lg-8 col-sm-8 col-6">
                    <h5 class="card-header">Data Raport</h5>
                </div>
                <div class="col-lg-4 col-sm-4 col-6 text-end">
                    <a href="<?= base_url('kepsek/kelola_raport'); ?>" class="btn btn-primary mt-3 mx-4">
                        <span class="tf-icons bx bx-arrow-back"></span>&nbsp;
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered text-center" id="myTable">
                        <thead>
                            <tr class="table-primary">
                                <th colspan="3">Nama : <?= $siswa['nama_siswa'] ?></th>
                                <th colspan="2">Kelas : 
                                    <?php foreach ($kelas as $key => $value): ?>
                                        <?php if ($siswa['id_kelas'] == $value['id_kelas']): ?>
                                            (<?= $value['tingkat'] ?> <?= $value['jurusan'] ?> <?= $value['kelas'] ?>)
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="5" style="border-right: 0px; border-left: 0px;"></th>
                            </tr>
                            <tr class="table-active">
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Rata-Rata</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $i = 1; ?>
                            <?php foreach ($raport as $item): ?>
                                <?php if ($item['id_siswa'] == $raportSiswa): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>
                                            <?php foreach ($mapel as $key => $value): ?>
                                                <?php if ($value['id_mapel'] == $item['id_mapel']): ?>
                                                    <?= $value['mata_pelajaran'] ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </td>
                                        <td><?= $item['nilai_uts'] ?></td>
                                        <td><?= $item['nilai_uas'] ?></td>
                                        <td><?= $item['rata_rata'] ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Nilai Akhir</th>
                                <th><?= $nilaiAkhir; ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="demo-inline-spacing">
                    <nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- JS -->
                        </ul>
                        <select class="form-select" id="items-per-page" style="width: 73px;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="75">75</option>
                            <option value="100">100</option>
                        </select>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>