<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard /</span> Kelola Kelas
        </h4>
        <?= $this->include('components/alerts'); ?>
        <div class="card">
            <div style="position: relative;">
                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary" style="position: absolute; top: 20px; right: 20px;">
                    <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Kelas
                </a>
            </div>
            <h5 class="card-header">Data Set Kelas</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $counter = 1; ?>
                        <?php foreach ($kelas as $item) : ?>
                            <tr>
                                <td><?= $counter++ ?></td>
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
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/kelola_kelas/add/') ?>" method="POST">
          <div class="modal-body">
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="tingkat" class="form-label">Tingkat</label>
                    <select id="tingkat" name="tingkat" class="select2 form-select" required>
                        <option selected disabled>--Pilih Tingkat Kelas--</option>
                        <option>X</option>
                        <option>XI</option>
                        <option>XII</option>
                    </select>
                </div>
                <div class="col mb-0">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select id="kelas" name="kelas" class="select2 form-select" required>
                        <option selected disabled>--Pilih Kelas--</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                        <option>F</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb-0 mt-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input class="form-control" type="text" id="jurusan" name="jurusan" placeholder="Jurusan" required />
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

<?php foreach ($kelas as $key => $item) : ?>
    <div class="modal fade" id="hapus-<?= $item['id_kelas'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= base_url('admin/kelola_kelas/delete/' . $item['id_kelas']) ?>">
              <div class="modal-body">
                  <p>Yakin ingin menghapus data kelas <b><?= $item['tingkat']; ?> <?= $item['kelas']; ?> (<?= $item['jurusan']; ?>)</b>? klik hapus jika Ya!</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
                  <button type="submit" class="btn btn-primary">Hapus</button>
              </div>
          </form>
      </div>
  </div>
</div>

<div class="modal fade" id="edit-<?= $item['id_kelas'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/kelola_kelas/update/' . $item['id_kelas']) ?>" method="POST">
          <div class="modal-body">
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="tingkat" class="form-label">Tingkat</label>
                    <select id="tingkat" name="tingkat" class="select2 form-select" required>
                        <option disabled>--Pilih Tingkat--</option>
                        <option <?= $item['tingkat'] == 'X' ? 'selected' : '' ?>>X</option>
                        <option <?= $item['tingkat'] == 'XI' ? 'selected' : '' ?>>XI</option>
                        <option <?= $item['tingkat'] == 'XII' ? 'selected' : '' ?>>XII</option>
                    </select>
                </div>
                <div class="col mb-0">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select id="kelas" name="kelas" class="select2 form-select" required>
                        <option disabled>--Pilih Kelas--</option>
                        <option <?= $item['kelas'] == 'A' ? 'selected' : '' ?>>A</option>
                        <option <?= $item['kelas'] == 'B' ? 'selected' : '' ?>>B</option>
                        <option <?= $item['kelas'] == 'C' ? 'selected' : '' ?>>C</option>
                        <option <?= $item['kelas'] == 'D' ? 'selected' : '' ?>>D</option>
                        <option <?= $item['kelas'] == 'E' ? 'selected' : '' ?>>E</option>
                        <option <?= $item['kelas'] == 'F' ? 'selected' : '' ?>>F</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb-0 mt-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input class="form-control" type="text" id="jurusan" name="jurusan" placeholder="Email Aktif" required value="<?= $item['jurusan'] ?>" />
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