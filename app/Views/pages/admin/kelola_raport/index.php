<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Home /</span> <?= $title; ?>
        </h4>
        <?= $this->include('components/alerts'); ?>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label" for="kelasSelect">Pilih Kelas</label>
                        <select class="form-select placement-dropdown" name="kelas" id="filter" onchange="filterTable()">
                            <option value="Semua Kelas">Semua Kelas</option>
                            <?php foreach ($kelas as $kelasItem) : ?>
                                <option value="<?= $kelasItem['tingkat'] ?> <?= $kelasItem['jurusan'] ?> <?= $kelasItem['kelas'] ?>" <?= ('Semua Kelas' === $kelasItem['kelas']) ? 'selected' : ''; ?>><?= $kelasItem['tingkat'] ?> <?= $kelasItem['jurusan'] ?> <?= $kelasItem['kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="card-header">Data Raport</h5>
                </div>
                <div class="col-md-4 text-end">
                    <div class="btn-group mt-3" style="margin-right: 20px;">
                        <button type="button" class="btn btn-primary dropdown-toggle mr-3" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('admin/kelola_raport/new') ?>">Tambah Nilai</a></li>
                            <hr class="dropdown-divider" />
                            <li><a class="dropdown-item" href="<?= base_url('admin/kelola_raport/cetak-pdf') ?>">Cetak PDF</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table text-center" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Tahun Ajar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $i = 1; ?>
                        <?php $processedSiswa = []; foreach ($raport as $item): ?>
                        <?php if (!in_array($item['id_siswa'], $processedSiswa)): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <?php foreach ($siswa as $sis): ?>
                                    <?php if ($sis['id_siswa'] == $item['id_siswa']): ?>
                                        <td><?= $sis['nama_siswa'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($kelas as $kel): ?>
                                    <?php if ($kel['id_kelas'] == $item['id_kelas']): ?>
                                        <td><?= $kel['tingkat'] ?> <?= $kel['jurusan'] ?> <?= $kel['kelas'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($tahun as $tah): ?>
                                    <?php if ($tah['id_thn_ajar'] == $item['id_thn_ajar']): ?>
                                        <td><?= $tah['tahun'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <td>
                                    <a type="button" href="<?= base_url('admin/kelola_raport/view/' . $item['id_siswa']) ?>" class="btn rounded-pill btn-primary btn-sm"><i class="bx bx-book-bookmark"></i> Raport</a>
                                    <a type="button" href="<?= base_url('admin/kelola_raport/cetak_raport/' . $item['id_siswa']) ?>" class="btn rounded-pill btn-danger btn-sm"><i class="bx bx-printer"></i> Cetak</a>
                                </td>
                            </tr>
                            <?php $processedSiswa[] = $item['id_siswa']; endif; ?>
                        <?php endforeach ?>
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

<?php foreach ($raport as $key => $item) : ?>
    <div class="modal fade" id="hapus-<?= $item['id_raport'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= base_url('admin/kelola_raport/delete/' . $item['id_raport']) ?>">
              <div class="modal-body">
                <p>Yakin ingin menghapus data ini? klik hapus jika Ya!</p>
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
    function filterTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("filter");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        var counter = 1; 

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; 
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (filter === "SEMUA KELAS" || txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    tr[i].getElementsByTagName("td")[0].innerText = counter++;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


<?= $this->endSection(); ?>