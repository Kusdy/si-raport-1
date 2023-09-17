<?= $this->extend('layouts/dashboard-guru/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Nilai
        </h4>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('guru/search'); ?>" method="post">
                        <div class="row gx-3 gy-2 align-items-center">
                            <div class="col-md-3">
                                <label class="form-label" for="kelasSelect">Pilih Kelas</label>
                                <select class="form-select placement-dropdown" name="kelas" id="kelasSelect" required>
                                    <option value="Semua Kelas">Semua Kelas</option>
                                    <?php foreach ($kelasOption as $kelasItem) : ?>
                                        <option value="<?= $kelasItem['kelas']; ?>" <?= ($selectedKelas === $kelasItem['kelas']) ? 'selected' : ''; ?>><?= $kelasItem['kelas']; ?> - <?= $kelasItem['tingkat']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="showToastPlacement">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?= $this->include('components/alerts'); ?>
            <div class="card">
                <?php if ($selectedKelas) : ?>
                    <h5 class="card-header">Data Kelas: <?= $selectedKelas; ?></h5>
                <?php else : ?>
                    <h5 class="card-header">Data Set Kelas</h5>
                <?php endif; ?>
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>aksi</th>
                                <th>Mapel</th>
                                <th>nilai</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $counter = 1; ?>
                            <?php foreach ($siswa as $item) : ?>
                                <tr>
                                    <td><?= $counter++ ?></td>
                                    <td><?= $item['nama_siswa'] ?></td>
                                    <td><?= $item['tingkat']; ?> <?= $item['kelas']; ?></td>
                                    <td><?= $item['jurusan']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-<?= $item['id_kelas'] ?>"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                                <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapus-<?= $item['id_kelas'] ?>" data-delete-url="<?= base_url('admin/kelola_kelas/delete/' . $item['id_kelas']) ?>"><i class="bx bx-trash me-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td> <input type="text" name="nilai"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>