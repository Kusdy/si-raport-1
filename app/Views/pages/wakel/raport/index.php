<?= $this->extend('layouts/dashboard-wakel/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Raport
        </h4>
        <div class="col-md-12">
            <?= $this->include('components/alerts'); ?>
            <div class="card">
                <div class="card-header">
                    <div class="add-button-container">
                        <h5>Data Nilai</h5>
                        <a href="<?= base_url('wakel/nilai/new'); ?>" class="btn btn-primary add-button">
                            <span class="tf-icons bx bxs-printer"></span>&nbsp;Cetak
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas/Jurusan</th>
                                    <th>Mapel</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php $counter = 1; ?>
                                <?php foreach ($raport as $item) : ?>
                                <tr>
                                    <td><?= $counter++ ?></td>
                                    <td><?= $item['nama_siswa'] ?></td>
                                    <td><?= $item['tingkat']; ?> <?= $item['kelas']; ?>(<?= $item['jurusan']; ?>)</td>
                                    <td><?= $item['mata_pelajaran']; ?> - <?= $item['nama_guru']; ?></td>
                                    <td><?= $item['nilai_uts']; ?></td>
                                    <td><?= $item['nilai_uas']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#edit-<?= $item['id_raport']; ?>">
                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                </a>
                                                <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#hapus-<?= isset($item['id_raport']) ? $item['id_raport'] : ''; ?>"
                                                    data-delete-url="<?= base_url('wakel/raport/delete/') ?>">
                                                    <i class="bx bx-trash me-2"></i> Delete
                                                </a>
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
    </div>
</div>

<!-- Modal -->

<?php foreach($raport as $item): ?>
<!-- Modal Edit -->
<div class="modal fade" id="edit-<?= $item['id_raport']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Edit Nilai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('wakel/raport/update/' . $item['id_raport']); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_siswa[]" value="<?= $item['id_siswa']; ?>">
                    <div class="row mb-3">
                        <div class="col mb-0 mt-0 col-md-4">
                            <label class="form-label">Nama Siswa</label>
                            <input class="form-control" type="text" name="nama_siswa[]"
                                value="<?= $item['nama_siswa'] ?>" readonly>
                        </div>
                        <div class="col mb-0 mt-0 col-md-2">
                            <label for="mata_pelajaran" class="form-label">Pilih Mapel</label>
                            <select class="form-select" name="id_mapel[]">
                                <option selected disabled>Pilih Mapel</option>
                                <?php foreach ($mapel as $map): ?>
                                <option value="<?= $map['id_mapel'] ?>"
                                    <?= (isset($item['id_mapel']) && $item['id_mapel'] == $map['id_mapel']) ? 'selected' : ''; ?>>
                                    <?= $map['mata_pelajaran'] ?> -
                                    <?php foreach ($guru as $gur): ?>
                                    <?php if ($gur['id_guru'] == $map['id_guru']): ?>
                                    <?= $gur['nama_guru'] ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col mb-0 mt-0 col-md-2">
                            <label for="mata_pelajaran" class="form-label">Pilih Tahun Ajar</label>
                            <select class="form-select" name="tahunAjar[]">
                                <option selected disabled>Pilih Tahun Ajar</option>
                                <?php foreach ($tahunAjar as $tahun) : ?>
                                <option value="<?= $tahun['id_thn_ajar'] ?>"
                                    <?= (isset($item['id_thn_ajar']) && $item['id_thn_ajar'] == $tahun['id_thn_ajar']) ? 'selected' : ''; ?>>
                                    <?= $tahun['tahun'] ?> -
                                    <?php foreach ($semester as $sem) : ?>
                                    <?php if ($sem['id_semester'] == $tahun['id_semester']) : ?>
                                    Semester <?= $sem['semester'] ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col mb-0 mt-0 col-md-2">
                            <label for="mata_pelajaran" class="form-label">Nilai UTS</label>
                            <input class="form-control" type="text" placeholder="Nilai UTS" name="nilai_uts[]"
                                value="<?= isset($item['nilai_uts']) ? $item['nilai_uts'] : ''; ?>" required />
                        </div>
                        <div class="col mb-0 mt-0 col-md-2">
                            <label for="mata_pelajaran" class="form-label">Nilai UAS</label>
                            <input class="form-control" placeholder="Nilai UAS"
                                value="<?= isset($item['nilai_uas']) ? $item['nilai_uas'] : ''; ?>" type="text"
                                name="nilai_uas[]" required />
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
<!-- End Modal Edit -->

<!-- Modal Delete -->
<div class="modal fade" id="hapus-<?= $item['id_raport'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('wakel/raport/delete/' . $item['id_raport']) ?>" method="post">
                <div class="modal-body">
                    <p>Yakin ingin menghapus data Nilai <b><?= $item['nama_siswa']; ?> Kelas
                            <?= $item['tingkat']; ?><?= $item['kelas']; ?>(<?= $item['jurusan']; ?>)</b>? klik hapus
                        jika Ya!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Delete -->

<?php endforeach ?>

<?= $this->endSection(); ?>