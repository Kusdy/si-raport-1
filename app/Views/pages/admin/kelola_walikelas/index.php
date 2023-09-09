<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<?= $this->include('components/sweetAlerts'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kelola</span> Wali Kelas
        </h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header">
                <div class="add-button-container">
                    <h5>Data Wali Kelas</h5>
                    <a href="<?= base_url('admin/kelola_walikelas/new'); ?>" class="btn btn-primary add-button">
                        <i class="bx bx-plus me-0 me-sm-1"></i>Tambah Wali Kelas
                    </a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $i=1; ?>
                        <?php foreach($waliKelas as $item) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $item['nama_guru'] ?></td>
                            <td><?= $item['id_kelas'] ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="<?= base_url('admin/kelola_walikelas/edit/' . $item['id_wali_kelas']) ?>"><i
                                                class="bx bx-edit-alt me-2"></i> Edit</a>
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#confirmation-modal-<?= $item['id_wali_kelas'] ?>">
                                            <i class="bx bx-trash me-2"></i> Delete</a>
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

</div>

<!-- Modal -->
<?php foreach ($waliKelas as $key => $item) : ?>
<div class="modal fade" id="confirmation-modal-<?= $item['id_wali_kelas'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="mb-20">Apakah Anda yakin ingin menghapus data wali kelas ini?</h4>
                <i class="bx bx-trash"></i>
                <p class="mb-30" style="color: red;">Data wali kelas yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <a href="<?= base_url('admin/kelola_walikelas/delete/' . $item['id_wali_kelas']) ?>"
                    class="btn btn-primary">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?= $this->endSection(); ?>