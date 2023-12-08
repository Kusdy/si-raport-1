<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Data Pengguna
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="filterForm">
                            <div class="row gx-3 gy-2 align-items-center">
                                <div class="col-md-3">
                                    <label class="form-label" for="selectPlacement">Pilih Role Pengguna</label>
                                    <select class="form-select placement-dropdown" id="roleDropdown" name="role" required>
                                        <option value="all" selected>Semua Role</option>
                                        <?php
                                        $allowedRoles = ['Admin', 'Guru', 'Siswa', 'Wali kelas', 'Kepala sekolah'];
                                        foreach ($allowedRoles as $role) :
                                            ?>
                                            <option value="<?= $role; ?>"><?= $role; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="showToastPlacement">&nbsp;</label>
                                    <button class="btn btn-primary d-block" id="submitBtn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?= $this->include('components/alerts'); ?>
                <div class="card">
                    <div style="position: relative;">
                        <a type="button" href="<?= base_url('admin/data-pengguna/new') ?>" class="btn btn-primary" style="position: absolute; top: 20px; right: 20px;">
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Pengguna
                        </a>
                    </div>
                    <h5 class="card-header">Data Pengguna</h5>
                    <div class="table-responsive text-nowrap">
                        <table id="userTable" class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php $counter = 1; ?>
                                <?php
                                $roleOrder = ['Admin', 'Kepala sekolah', 'Wali kelas', 'Guru', 'Siswa'];

                                usort($dataUser, function ($a, $b) use ($roleOrder) {
                                    $roleA = array_search($a['role'], $roleOrder);
                                    $roleB = array_search($b['role'], $roleOrder);
                                    return $roleA - $roleB;
                                });

                                $counter = 1;

                                foreach ($dataUser as $item) :
                                    $roleClass = '';
                                    switch ($item['role']) {
                                        case 'Admin':
                                        $roleClass = 'bg-label-danger';
                                        break;
                                        case 'Guru':
                                        $roleClass = 'bg-label-success';
                                        break;
                                        case 'Siswa':
                                        $roleClass = 'bg-label-warning';
                                        break;
                                        case 'Wali kelas':
                                        $roleClass = 'bg-label-info';
                                        break;
                                        case 'Kepala sekolah':
                                        $roleClass = 'bg-label-primary';
                                        break;
                                        default:
                                        $roleClass = 'bg-label-secondary';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $counter++ ?></td>
                                        <td><?= $item['nama']; ?></td>
                                        <td><?= $item['email']; ?></td>
                                        <td><?= str_repeat('*', min(strlen($item['password']), 10)) ?></td>
                                        <td><span class="badge <?= $roleClass; ?> me-1"><?= $item['role']; ?></span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('admin/data-pengguna/edit/' . $item['id_user']) ?>"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapus-<?= $item['id_user'] ?>" data-delete-url="<?= base_url('admin/data-pengguna/delete/' . $item['id_user']) ?>"><i class="bx bx-trash me-2"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
<?php foreach ($dataUser as $key => $item) : ?>
    <div class="modal fade" id="hapus-<?= $item['id_user'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/data-pengguna/delete/' . $item['id_user']) ?>">
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data pengguna atas nama <b><?= $item['nama']; ?></b>? klik hapus jika Ya!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const submitBtn = document.getElementById('submitBtn');
        const tableRows = document.querySelectorAll('.table tbody tr');

        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const selectedRole = document.getElementById('roleDropdown').value;

            // Inisialisasi ulang counter ke 1
            let counter = 1;

            tableRows.forEach(function(row) {
                const roleCell = row.querySelector('td:nth-child(5)');
                if (selectedRole === 'all' || (roleCell && roleCell.textContent === selectedRole)) {
                    row.style.display = '';
                    // Tambahkan nomor urut ke tabel
                    row.querySelector('td:first-child').textContent = counter++;
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>