<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Home /</span> <?= $title; ?>
        </h4>
        <div class="col-xxl">
            <?= $this->include('components/alerts'); ?>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="add-button-container">
                        <h5>Data Raport : <?= $siswa['nama_siswa'] ?>
                        <?php foreach ($kelas as $key => $value): ?>
                            <?php if ($siswa['id_kelas'] == $value['id_kelas']): ?>
                                (<?= $value['tingkat'] ?> <?= $value['jurusan'] ?> <?= $value['kelas'] ?>)
                            <?php endif ?>
                        <?php endforeach ?>
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/kelola_raport/update/' . $siswa['id_siswa']) ?>" method="post"
                    enctype="multipart/form-data">

                    <?php foreach ($raport as $item): ?>
                        <?php if ($item['id_siswa'] == $raportSiswa): ?>
                            <div id="form-container">
                                <div id="kd-form-template">
                                    <div class="row mb-3">
                                        <input name="id_siswa[]" type="hidden" value="<?= $raportSiswa ?>">
                                        <input name="id_raport[]" type="hidden" value="<?= $raportSiswa ?>">
                                        <div class="col mb-0 mt-0 col-md-3">
                                            <label for="mata_pelajaran" class="form-label">Mapel</label>
                                            <select class="form-select" name="id_mapel[]">
                                                <option selected disabled>Mapel Terpilih</option>
                                                <?php foreach ($mapel as $map): ?>
                                                    <option value="<?= $map['id_mapel'] ?>" <?= ($item['id_mapel'] == $map['id_mapel'] ? 'selected' : '') ?>><?= $map['mata_pelajaran'] ?> -
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
                                            <label for="mata_pelajaran" class="form-label">Tahun Ajar</label>
                                            <input type="hidden" name="id_thn_ajar[]" value="<?= $item['id_thn_ajar'] ?>">
                                            <select class="form-select" name="id_thn_ajar[]" disabled>
                                                <option selected disabled>Tahun Ajar</option>
                                                <?php foreach ($tahun as $tah): ?>
                                                    <option value="<?= $tah['id_thn_ajar'] ?>" <?= ($item['id_thn_ajar'] == $tah['id_thn_ajar'] ? 'selected' : '') ?>><?= $tah['tahun'] ?> -
                                                        <?php foreach ($semester as $sem): ?>
                                                            <?php if ($sem['id_semester'] == $tah['id_semester']): ?>
                                                                Semester <?= $sem['semester'] ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col mb-0 mt-0 col-md-2">
                                            <label for="mata_pelajaran" class="form-label">UTS</label>
                                            <input class="form-control" type="text"
                                            placeholder="Nilai Ujian Tengah Semester UTS" name="nilai_uts[]" value="<?= $item['nilai_uts'] ?>" required />
                                        </div>
                                        <div class="col mb-0 mt-0 col-md-2">
                                            <label for="mata_pelajaran" class="form-label">UAS</label>
                                            <input class="form-control" placeholder="Nilai Ujian Akhir Semester UAS"
                                            type="text" name="nilai_uas[]" value="<?= $item['nilai_uas'] ?>" required />
                                        </div>
                                        <div class="col mb-0 mt-0 col-md-2">
                                            <label for="mata_pelajaran" class="form-label">Rata-Rata</label>
                                            <input class="form-control" placeholder="Nilai Ujian Akhir Semester UAS"
                                            type="text" value="<?= $item['rata_rata'] ?>" disabled />
                                        </div>
                                        <div class="col mb-0 mt-0 col-md-1">
                                            <label for="mata_pelajaran" class="form-label">Hapus</label>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#confirmation-modal-<?= $item['id_raport'] ?>" class="btn btn-danger"><i class="bx bx-trash text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <div class="mt-4">
                        <a type="button" href="<?= base_url('admin/kelola_raport') ?>"
                            class="btn btn-warning me-2"><i class="bx bx-arrow-back"></i> Back</a>
                            <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Simpan Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($raport as $key => $item): ?>
    <div class="modal fade" id="confirmation-modal-<?= $item['id_raport'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-20">Apakah Anda yakin ingin menghapus data ini?</h4>
                    <p class="mb-30" style="color: red;">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="<?= base_url('admin/kelola_raport/delete/' . $item['id_raport']) ?>" class="btn btn-primary">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection(); ?>