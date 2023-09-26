<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>
<?= $this->include('components/sweetAlerts'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kelola Set Kelas /</span> Tambah Data Set Kelas
        </h4>

        <div class="col-xxl">
            <?= $this->include('components/alerts'); ?>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/kelola_set_kelas/add') ?>" method="post"
                        enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kelas & Wali
                                Kelas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bxs-graduation"></i></span>
                                    <select class="form-select" name="id_wali_kelas">
                                        <option selected disabled>Pilih Kelas Dan Wali Kelas</option>
                                        <?php foreach ($waliOption as $item): ?>
                                        <option value="<?= $item['id_wali_kelas'] ?>">
                                            <?= $item['tingkat'] ?><?= $item['kelas']?>-<?= $item['jurusan'] ?>---
                                            <?= $item['nama_guru'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Alamat</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <?php foreach ($mapelData as $mapel): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            value="<?= $mapel['id_mapel'] ?>" id="mapel_<?= $mapel['id_mapel'] ?>"
                                            name="id_mapel[]">
                                        <label class="form-check-label" for="mapel_<?= $mapel['id_mapel'] ?>">
                                            <?= $mapel['mata_pelajaran'] ?>
                                        </label>
                                        &nbsp;
                                        &nbsp;
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Anggota
                                Kelas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bxs-graduation"></i></span>
                                    <select class="form-select" name="id_wali_kelas">
                                        <option selected disabled>Pilih Kelas Dan Wali Kelas</option>
                                        <?php foreach ($waliOption as $item): ?>
                                        <option value="<?= $item['id_wali_kelas'] ?>">
                                            <?= $item['tingkat'] ?><?= $item['kelas']?>-<?= $item['jurusan'] ?>---
                                            <?= $item['nama_guru'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="reset" class="btn btn-danger me-2">Reset</button>
                                <a href="<?= base_url('admin/kelola_set_kelas');?>"
                                    class="btn btn-warning me-2">Back</a>
                                <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>