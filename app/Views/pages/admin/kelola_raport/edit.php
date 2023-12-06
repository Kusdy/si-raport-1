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
                        <!-- <a href="#" class="btn btn-primary add-button" id="add-kd-button">
                            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah
                        </a> -->
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('') ?>" method="post"
                        enctype="multipart/form-data">

                        <?php foreach ($raport as $item): ?>
                            <?php if ($item['id_siswa'] == $raportSiswa): ?>
                                <div id="form-container">
                                    <div id="kd-form-template">
                                        <div class="row mb-3">
                                            <div class="col mb-0 mt-0 col-md-3">
                                                <label for="mata_pelajaran" class="form-label">Pilih Mapel</label>
                                                <select class="form-select" name="id_mapel[]">
                                                    <option selected disabled>Pilih Mapel</option>
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
                                            <div class="col mb-0 mt-0 col-md-3">
                                                <label for="mata_pelajaran" class="form-label">Pilih Tahun Ajar</label>
                                                <select class="form-select" name="id_thn_ajar[]">
                                                    <option selected disabled>Pilih Tahun Ajar</option>
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
                                                <label for="mata_pelajaran" class="form-label">Nilai UTS</label>
                                                <input class="form-control" type="text"
                                                placeholder="Nilai Ujian Tengah Semester UTS" name="nilai_uts[]" value="<?= $item['nilai_uts'] ?>" required />
                                            </div>
                                            <div class="col mb-0 mt-0 col-md-2">
                                                <label for="mata_pelajaran" class="form-label">Nilai UAS</label>
                                                <input class="form-control" placeholder="Nilai Ujian Akhir Semester UAS"
                                                type="text" name="nilai_uas[]" value="<?= $item['nilai_uas'] ?>" required />
                                            </div>
                                            <div class="col mb-0 mt-0 col-md-2">
                                                <label for="mata_pelajaran" class="form-label">Rata-Rata</label>
                                                <input class="form-control" placeholder="Nilai Ujian Akhir Semester UAS"
                                                type="text" value="<?= $item['rata_rata'] ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2 disabled">Simpan (Belum)</button>
                            <!-- <button type="reset" class="btn btn-danger me-2">Reset</button> -->
                            <a type="button" href="<?= base_url('admin/kelola_raport') ?>"
                                class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>