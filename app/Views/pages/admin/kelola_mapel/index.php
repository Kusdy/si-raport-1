<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Kelola Mata Pelajaran
        </h4>

        <?= $this->include('components/alerts'); ?>

        <div class="card">
            <div style="position: relative;">
                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary"
                    style="position: absolute; top: 20px; right: 20px;">
                    <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Mapel
                </a>
            </div>
            <h5 class="card-header">Data Mata Pelajaran </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $counter = 1; ?>
                        <?php foreach ($mapel as $item) : ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td> <?= $item['mata_pelajaran']; ?></td>
                            <td><?= $item['nama_guru']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#edit-<?= $item['id_mapel'] ?>"><i
                                                class="bx bx-edit-alt me-2"></i> Edit</a>
                                        <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#hapus-<?= $item['id_mapel'] ?>"
                                            data-delete-url="<?= base_url('admin/kelola_mapel/delete/' . $item['id_mapel']) ?>"><i
                                                class="bx bx-trash me-2"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/kelola_mapel/add/') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0 mt-3">
                            <label for="mata_pelajaran" class="form-label">Pilih Guru</label>
                            <select class="form-select" name="id_guru">
                                <option selected disabled>Pilih Guru</option>
                                <?php foreach ($guruOption as $item): ?>
                                <option value="<?= $item['id_guru'] ?>">
                                    <?= $item['nama_guru'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0 mt-3">
                            <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                            <input class="form-control" type="text" id="mata_pelajaran" name="mata_pelajaran"
                                placeholder="Nama mata pelajaran." required />
                        </div>
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

<?php foreach ($mapel as $key => $item) : ?>
<div class="modal fade" id="hapus-<?= $item['id_mapel'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/kelola_mapel/delete/' . $item['id_mapel']) ?>">
                <div class="modal-body">
                    <p>Yakin ingin menghapus data mapel <b><?= $item['mata_pelajaran']; ?>
                            (<?= $item['nama_guru']; ?>)</b>? klik hapus jika Ya!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-<?= $item['id_mapel'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/kelola_mapel/update/' . $item['id_mapel']) ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0 mt-3">
                            <label for="mata_pelajaran" class="form-label">Pilih Guru</label>
                            <select class="form-select" name="id_guru">
                                <option selected disabled>Pilih Guru</option>
                                <?php foreach ($guruOption as $guruItem): ?>
                                <option value="<?= $guruItem['id_guru'] ?>"
                                    <?php if($guruItem['id_guru'] == $item['id_guru']) echo 'selected' ?>>
                                    <?= $guruItem['nama_guru'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0 mt-3">
                            <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                            <input class="form-control" type="text" id="mata_pelajaran" name="mata_pelajaran"
                                placeholder="Nama mata pelajaran." value="<?= $item['mata_pelajaran'] ?>" required />
                        </div>
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
<?php endforeach; ?>

<?= $this->endSection(); ?>