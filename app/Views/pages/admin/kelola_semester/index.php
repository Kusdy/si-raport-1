<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Kelola Semester
        </h4>
        <?= $this->include('components/alerts'); ?>
        <div class="card">
            <div style="position: relative;">
                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary" style="position: absolute; top: 20px; right: 20px;">
                    <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Semester
                </a>
            </div>
            <h5 class="card-header">Data Set Semester</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th class="text-center">Semester</th>
                            <th class="text-center">Semester Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $counter = 1; ?>
                        <?php
                        $semesterData = ['Ganjil', 'Genap'];

                        usort($semester, function ($a, $b) use ($semesterData) {
                            $smstrA = array_search($a['ket_semester'], $semesterData);
                            $smstrB = array_search($b['ket_semester'], $semesterData);
                            return $smstrA - $smstrB;
                        });

                        $counter = 1;

                        foreach ($semester as $item):
                            $smstr = '';
                            switch ($item['ket_semester']) {
                                case 'Ganjil':
                                $smstr = 'bg-label-danger';
                                break;
                                case 'Genap':
                                $smstr = 'bg-label-primary';
                                break;
                                default:
                                $smstr = 'bg-label-secondary';
                            }
                            ?>
                            <tr>
                                <td><?= $counter++ ?></td>
                                <td align="center"><?= $item['semester']; ?></td>
                                <td align="center"><span class="badge <?= $smstr; ?> me-1"><?= $item['ket_semester']; ?></span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-<?= $item['id_semester'] ?>"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapus-<?= $item['id_semester'] ?>" data-delete-url="<?= base_url('admin/kelola_semester/delete/' . $item['id_semester']) ?>"><i class="bx bx-trash me-2"></i> Delete</a>
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

<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Semester</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/kelola_semester/add/') ?>" method="POST">
          <div class="modal-body">
            <div class="col mb-3">
                <label for="semester" class="form-label">semester</label>
                <select id="semester" name="semester" class="select2 form-select" required>
                    <option selected disabled>--Pilih Semester--</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                </select>
            </div>
            <div class="col mb-0">
                <label for="ket_semester" class="form-label">Ajaran Semester</label>
                <select id="ket_semester" name="ket_semester" class="select2 form-select" required>
                    <option selected disabled>--Pilih Ajaran Semester--</option>
                    <option>Ganjil</option>
                    <option>Genap</option>
                </select>
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

<?php foreach ($semester as $key => $item) : ?>
    <div class="modal fade" id="hapus-<?= $item['id_semester'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= base_url('admin/kelola_semester/delete/' . $item['id_semester']) ?>">
              <div class="modal-body">
                  <p>Yakin ingin menghapus data semester <b><?= $item['semester']; ?> (<?= $item['ket_semester']; ?>)</b>? klik hapus jika Ya!</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Hapus</button>
              </div>
          </form>
      </div>
  </div>
</div>

<div class="modal fade" id="edit-<?= $item['id_semester'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Semester</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/kelola_semester/update/' . $item['id_semester']) ?>" method="POST">
          <div class="modal-body">
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="semester" class="form-label">Semester</label>
                    <select id="semester" name="semester" class="select2 form-select" required>
                        <option disabled>--Pilih Semester--</option>
                        <option <?= $item['semester'] == '1' ? 'selected' : '' ?>>1</option>
                        <option <?= $item['semester'] == '2' ? 'selected' : '' ?>>2</option>
                        <option <?= $item['semester'] == '3' ? 'selected' : '' ?>>3</option>
                        <option <?= $item['semester'] == '4' ? 'selected' : '' ?>>4</option>
                        <option <?= $item['semester'] == '5' ? 'selected' : '' ?>>5</option>
                        <option <?= $item['semester'] == '6' ? 'selected' : '' ?>>6</option>
                    </select>
                </div>
                <div class="col mb-0">
                    <label for="ket_semester" class="form-label">Semester Ajaran</label>
                    <select id="ket_semester" name="ket_semester" class="select2 form-select" required>
                        <option disabled>--Pilih ket_semester--</option>
                        <option <?= $item['ket_semester'] == 'Ganjil' ? 'selected' : '' ?>>Ganjil</option>
                        <option <?= $item['ket_semester'] == 'Genap' ? 'selected' : '' ?>>Genap</option>
                    </select>
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