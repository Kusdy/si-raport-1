<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<?= $this->include('components/sweetAlerts'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kelola Wali Kelas /</span> Edit Data Wali Kelas
        </h4>

        <div class="col-xxl">
            <?= $this->include('components/alerts'); ?>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/kelola_walikelas/update/' . $waliKelas['id_wali_kelas']) ?>"
                        method="post" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kelas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-card"></i></span>
                                    <select class="form-select" name="id_kelas">
                                        <option selected disabled>Pilih kelas</option>
                                        <?php foreach ($kelasOption as $item): ?>
                                        <option value="<?= $item['id_kelas'] ?>"
                                            <?php if($item['id_kelas'] == $waliKelas['id_kelas']) echo 'selected' ?>>
                                            <?= $item['tingkat'] ?><?= $item['kelas']?>-<?= $item['jurusan']?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Guru</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <select class="form-select" name="id_guru">
                                        <option select disabled>Pilih Guru</option>
                                        <?php foreach ($guruOption as $item): ?>
                                        <option value="<?= $item['id_guru'] ?>"
                                            <?php if($item['id_guru'] == $waliKelas['id_guru']) echo 'selected' ?>>
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
                                <a href="<?= base_url('admin/kelola_walikelas');?>"
                                    class="btn btn-warning me-2">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>