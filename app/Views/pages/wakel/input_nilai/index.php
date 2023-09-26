<?= $this->extend('layouts/dashboard-wakel/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Tables /</span> Input Nilai
        </h4>

        <!-- Basic Bootstrap Table -->
        <?= $this->include('components/alerts'); ?>
        <div class="card">

            <h5 class="card-header">Table Input Nilai</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>nama Guru</th>
                            <th>Kelas</th>
                            <th>Nilai KD</th>
                            <th>Nilai Mapel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td>Albert Cook</td>
                            <td>imam</td>
                            <td>XI</td>
                            <td>8</td>
                            <td>9</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a type="button" class="dropdown-item" href="<?= base_url('wakel/tambah_nilai') ?>"><i class="bx bx-plus me-1"></i> Tambah</a>
                                        <a class="dropdown-item" href="<?= base_url('wakel/edit_nilai') ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>