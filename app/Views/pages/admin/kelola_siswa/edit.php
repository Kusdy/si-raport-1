<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<?= $this->include('components/sweetAlerts'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Edit Data </span>Siswa
        </h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/kelola_siswa/update/' . $siswa['id_siswa']) ?>" method="post"
                        enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kelas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-book-add"></i></span>
                                    <select class="form-select" name="id_kelas">
                                        <option>Pilih kelas</option>
                                        <option value="1" <?php if($siswa['id_kelas'] === '1') echo 'selected'; ?>>Kelas
                                            1</option>
                                        <option value="2" <?php if($siswa['id_kelas'] === '2') echo 'selected'; ?>>Kelas
                                            2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Tahun
                                Ajaran</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-list-ol"></i></span>
                                    <select class="form-select" name="id_tahun_ajar">
                                        <option>Pilih Tahun Ajaran</option>
                                        <option value="1" <?php if($siswa['id_tahun_ajar'] === '1') echo 'selected'; ?>>
                                            2023/2024</option>
                                        <option value="2" <?php if($siswa['id_tahun_ajar'] === '2') echo 'selected'; ?>>
                                            2024/2025</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama
                                lengkap</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname"
                                        placeholder="Nama lengkap" name="nama_siswa"
                                        value="<?= $siswa['nama_siswa']?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">NISN</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text"><i
                                            class="bx bx-id-card"></i></span>
                                    <input type="text" class="form-control" placeholder="1123xxx" name="nis"
                                        value="<?= $siswa['nis']?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tanggal
                                Lahir</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text"><i
                                            class="bx bx-calendar"></i></span>
                                    <input type="date" class="form-control" placeholder="1123xxx" name="tgl_lahir"
                                        value="<?= $siswa['tgl_lahir']?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Jenis
                                Kelamin</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bx bx-male-female"></i></span>
                                    <select class="form-select" name="jk">
                                        <option>Jenis Kelamin</option>
                                        <option value="L" <?php if($siswa['jk'] === 'L') echo 'selected'; ?>>
                                            Laki-laki</option>
                                        <option value="P" <?php if($siswa['jk'] === 'P') echo 'selected'; ?>>Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Nama Ibu</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bx bx-female"></i></span>
                                    <input type="text" class="form-control" placeholder="Nama Lenkap Ibu Kandung"
                                        name="nama_ibu" value="<?= $siswa['nama_ibu']?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Nama Ayah</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bx bx-male"></i></span>
                                    <input type="text" class="form-control" placeholder="Nama Lenkap Ayah Kandung"
                                        name="nama_ayah" value="<?= $siswa['nama_ayah']?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Foto</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="bx bx-image-alt"></i></span>
                                    <input type="file" class="form-control" accept="image/jpeg, image/png"
                                        name="foto" />
                                </div>
                                <img src="<?= base_url('uploads/siswa/' . $siswa['foto']) ?>" alt="Siswa Image"
                                    id="gambarPreview" class="img-fluid mt-3" style="max-width: 300px;" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="text" id="basic-icon-default-email" class="form-control"
                                        placeholder="adminExample" name="email" value="<?= $siswa['email']?>" />
                                    <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="bx bx-phone"></i></span>
                                    <input type="text" class="form-control phone-mask" placeholder="08xxx" name="no_hp"
                                        value="<?= $siswa['no_hp']?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Alamat</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <textarea class="form-control" rows="10"
                                        name="alamat"><?= $siswa['alamat']?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <a href="<?= base_url('admin/kelola_siswa');?>" class="btn btn-dark">Close</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    var preview = document.getElementById('gambarPreview');
    preview.src = URL.createObjectURL(event.target.files[0]);
}
</script>

<?= $this->endSection(); ?>