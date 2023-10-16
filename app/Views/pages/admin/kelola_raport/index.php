<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Home /</span> <?= $title; ?>
        </h4>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label" for="kelasSelect">Pilih Kelas</label>
                        <select class="form-select placement-dropdown select2" name="kelas" id="kelasSelect" required>
                            <option value="Semua Kelas">Semua Kelas</option>
                            <?php foreach ($kelas as $kelasItem) : ?>
                                <option value="<?= $kelasItem['kelas']; ?>" <?= ($selectedKelas === $kelasItem['kelas']) ? 'selected' : ''; ?>><?= $kelasItem['tingkat']; ?> <?= $kelasItem['kelas']; ?> - <?= $kelasItem['jurusan']; ?></option>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Nama Guru</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Tahun Ajar</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Rata-rata</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="kelasTerpilih">
                        <?php $i = 1; ?>
                        <?php foreach ($raport as $item): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <?php foreach ($siswa as $sis): ?>
                                    <?php if ($sis['id_siswa'] == $item['id_siswa']): ?>
                                        <td><?= $sis['nama_siswa'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($guru as $gur): ?>
                                    <?php if ($gur['id_guru'] == $item['id_guru']): ?>
                                        <td><?= $gur['nama_guru'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($mapel as $map): ?>
                                    <?php if ($map['id_mapel'] == $item['id_mapel']): ?>
                                        <td><?= $map['mata_pelajaran'] ?></td>
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
                                <td><?= $item['nilai_uts'] ?></td>
                                <td><?= $item['nilai_uas'] ?></td>
                                <td><?= $item['rata_rata'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('admin/kelola_raport/edit') ?>"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
                <select class="form-select" id="items-per-page" style="width: 100px;">
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

<script>
    // Tangani perubahan dropdown
    document.getElementById('kelasSelect').addEventListener('change', function() {
        // Dapatkan nilai yang dipilih
        var selectedValue = this.value;

        // Dapatkan semua baris tabel
        var tableRows = document.querySelectorAll("tbody#kelasTerpilih tr");

        // Sembunyikan semua baris tabel
        for (var i = 0; i < tableRows.length; i++) {
            tableRows[i].style.display = "none";
        }

        // Tampilkan hanya baris yang sesuai dengan kelas yang dipilih
        if (selectedValue === "Semua Kelas") {
            // Jika "Semua Kelas" dipilih, tampilkan semua baris
            for (var i = 0; i < tableRows.length; i++) {
                tableRows[i].style.display = "";
            }
        } else {
            // Jika kelas tertentu dipilih, tampilkan hanya baris yang cocok
            for (var i = 0; i < tableRows.length; i++) {
                var kelasColumn = tableRows[i].querySelector("td:nth-child(5)");
                if (kelasColumn.textContent.includes(selectedValue)) {
                    tableRows[i].style.display = "";
                }
            }
        }
    });
</script>



<?= $this->endSection(); ?>