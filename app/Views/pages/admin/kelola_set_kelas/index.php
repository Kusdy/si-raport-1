<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Set Kelas
        </h4>

        <?= $this->include('components/alerts'); ?>

        <div class="card">
            <div style="position: relative;">
                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary"
                    style="position: absolute; top: 20px; right: 20px;">
                    <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Set Kelas
                </a>
            </div>
            <h5 class="card-header">Data Mata Pelajaran </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Wali Kelas</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $counter = 1; ?>
                        <?php foreach($setKelas as $item) : ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= $item['nama_guru'] ?></td>
                            <td><?= $item['tingkat'] ?><?= $item['kelas'] ?>-<?= $item['jurusan'] ?></td>
                            <td>
                                <?php foreach ($item['mata_pelajaran'] as $mapel) : ?>
                                <?= $mapel['mata_pelajaran'] ?><br>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/kelola_set_kelas/edit/' . $item['id_set_kelas']) ?>"
                                    class="btn btn-warning btn-sm btn-circle" data-bs-toggle="modal"
                                    data-bs-target="#edit-<?= $item['id_set_kelas'] ?>"> <i
                                        class="nav-icon fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/kelola_set_kelas/delete/' . $item['id_set_kelas']) ?>"
                                    class="btn btn-danger btn-sm btn-circle" data-bs-toggle="modal"
                                    data-bs-target="#hapus-<?= $item['id_set_kelas'] ?>"
                                    data-delete-url="<?= base_url('admin/kelola_set_kelas/delete/' . $item['id_set_kelas']) ?>">
                                    <i class="nav-icon fas fa-trash"></i>
                                </a>

                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Set Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/kelola_set_kelas/add/') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0 mt-3">
                            <label for="mata_pelajaran" class="form-label">Kelas Dan Wali Kelas</label>
                            <select class="form-select" name="id_wali_kelas">
                                <option selected disabled>Pilih Kelas Dan Wali Kelas</option>
                                <?php foreach ($waliOption as $item): ?>
                                <option value="<?= $item['id_wali_kelas'] ?>">
                                    <?= $item['tingkat'] ?><?= $item['kelas']?>-<?= $item['jurusan'] ?>---
                                    <?= $item['nama_guru'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($mapelData as $mapel): ?>
                        <div class="col mb-0 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?= $mapel['id_mapel'] ?>"
                                    id="mapel_<?= $mapel['id_mapel'] ?>" name="id_mapel[]">
                                <label class="form-check-label" for="mapel_<?= $mapel['id_mapel'] ?>">
                                    <?= $mapel['mata_pelajaran'] ?>
                                </label>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($setKelas as $item):?>
<div class="modal fade" id="hapus-<?= $item['id_set_kelas'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/kelola_set_kelas/delete/' . $item['id_set_kelas']) ?>">
                <div class="modal-body">
                    <p>Yakin ingin menghapus data kelas <b><?= $item['tingkat']; ?> <?= $item['kelas']; ?>
                            (<?= $item['jurusan']; ?>)</b>? klik hapus jika Ya!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-<?= $item['id_set_kelas'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Data Set Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/kelola_set_kelas/update/' . $item['id_set_kelas']) ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0 mt-3">
                            <label for="mata_pelajaran" class="form-label">Kelas Dan Wali Kelas</label>
                            <select class="form-select" name="id_wali_kelas">
                                <option selected disabled>Pilih Kelas Dan Wali Kelas</option>
                                <?php foreach ($waliOption as $waliItem): ?>
                                <option value="<?= $waliItem['id_wali_kelas'] ?>"
                                    <?php if ($waliItem['id_wali_kelas'] === $item['id_wali_kelas']): ?> selected
                                    <?php endif; ?>>
                                    <?= $waliItem['tingkat'] ?><?= $waliItem['kelas'] ?>-<?= $waliItem['jurusan'] ?>---
                                    <?= $waliItem['nama_guru'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($mapelData as $mapel): ?>
                        <div class="col mb-0 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?= $mapel['id_mapel'] ?>"
                                    id="mapel_<?= $mapel['id_mapel'] ?>" name="id_mapel[]"
                                    <?php if (in_array($mapel['id_mapel'], json_decode($item['id_mapel']))): ?> checked
                                    <?php endif; ?>>
                                <label class="form-check-label" for="mapel_<?= $mapel['id_mapel'] ?>">
                                    <?= $mapel['mata_pelajaran'] ?>
                                </label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php endforeach ?>

<?= $this->endSection(); ?>