<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<?= $this->include('components/sweetAlerts'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tambah Data </span>Wali Kelas
        </h4>

        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/kelola_walikelas/add') ?>" method="post"
                        enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kelas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-card"></i></span>
                                    <select class="form-select" name="id_kelas">
                                        <option>Pilih kelas</option>
                                        <option value="1">Kelas 1</option>
                                        <option value="2">Kelas 2</option>
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
                                        <option value="<?= $item['id_guru'] ?>"><?= $item['nama_guru'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <a href="<?= base_url('admin/kelola_walikelas');?>" class="btn btn-dark">Close</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>