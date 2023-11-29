<?= $this->extend('layouts/dashboard-wakel/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Dashboard / Nilai /</span> Tambah Nilai
        </h4>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('wakel/search'); ?>" method="post">
                        <div class="row gx-3 gy-2 align-items-center">
                            <div class="col-md-3">
                                <label class="form-label" for="kelasSelect">Pilih Kelas</label>
                                <select class="form-select placement-dropdown select2" name="kelas" id="kelasSelect"
                                    required>
                                    <option value="Semua Kelas">Semua Kelas</option>
                                    <?php foreach ($kelasOption as $kelasItem) : ?>
                                    <option value="<?= $kelasItem['kelas']; ?>"
                                        <?= ($selectedKelas === $kelasItem['kelas']) ? 'selected' : ''; ?>>
                                        <?= $kelasItem['tingkat']; ?> <?= $kelasItem['kelas']; ?> -
                                        <?= $kelasItem['jurusan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="showToastPlacement">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block position-relative"
                                    style="height: 30px; width: 30px;">
                                    <i class="fas fa-search position-absolute top-50 start-50 translate-middle"
                                        style="transform: translate(-50%, -50%);"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?= $this->include('components/alerts'); ?>
            <div class="card">
                <?php if ($selectedKelas) : ?>
                <div class="card-header">
                    <div class="add-button-container">
                        <h5>Data Kelas: <?= $selectedKelas; ?></h5>
                    </div>
                </div>
                <?php else : ?>
                <div class="card-header">
                    <h5>Data Set Kelas</h5>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="<?= base_url('wakel/nilai/add'); ?>" method="post">
                        <div id="form-container">
                            <div id="kd-form-template">
                                <?php foreach ($siswa as $item) : ?>
                                <input type="hidden" name="id_siswa[]" value="<?= $item['id_siswa']; ?>">
                                <div class="row mb-3">
                                    <div class="col mb-0 mt-0 col-md-3">
                                        <label class="form-label">Nama Siswa</label>
                                        <input class="form-control" type="text" name="nama_siswa[]"
                                            value="<?= $item['nama_siswa'] ?>" readonly>
                                    </div>
                                    <div class="col mb-0 mt-0 col-md-2">
                                        <label for="mata_pelajaran" class="form-label">Pilih Mapel</label>
                                        <select class="form-select" name="id_mapel[]">
                                            <option selected disabled>Pilih Mapel</option>
                                            <?php foreach ($mapel as $map): ?>
                                            <option value="<?= $map['id_mapel'] ?>"
                                                <?= (isset($item['id_mapel']) && $item['id_mapel'] == $map['id_mapel']) ? 'selected' : ''; ?>>
                                                <?= $map['mata_pelajaran'] ?> -
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
                                        <label for="mata_pelajaran" class="form-label">Pilih Tahun Ajar</label>
                                        <select class="form-select" name="tahunAjar[]">
                                            <option selected disabled>Pilih Tahun Ajar</option>
                                            <?php foreach ($tahunAjar as $tahun) : ?>
                                            <option value="<?= $tahun['id_thn_ajar'] ?>"
                                                <?= (isset($item['id_thn_ajar']) && $item['id_thn_ajar'] == $tahun['id_thn_ajar']) ? 'selected' : ''; ?>>
                                                <?= $tahun['tahun'] ?> -
                                                <?php foreach ($semester as $sem) : ?>
                                                <?php if ($sem['id_semester'] == $tahun['id_semester']) : ?>
                                                Semester <?= $sem['semester'] ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col mb-0 mt-0 col-md-2">
                                        <label for="mata_pelajaran" class="form-label">Nilai UTS</label>
                                        <input class="form-control" type="text" placeholder="Nilai UTS"
                                            name="nilai_uts[]"
                                            value="<?= isset($item['nilai_uts']) ? $item['nilai_uts'] : ''; ?>"
                                            required />
                                    </div>
                                    <div class="col mb-0 mt-0 col-md-2">
                                        <label for="mata_pelajaran" class="form-label">Nilai UAS</label>
                                        <input class="form-control" placeholder="Nilai UAS"
                                            value="<?= isset($item['nilai_uas']) ? $item['nilai_uas'] : ''; ?>"
                                            type="text" name="nilai_uas[]" required />
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary me-2"
                                formaction="<?= base_url('wakel/nilai/add') ?>">Simpan</button>
                            <button type="reset" class="btn btn-danger me-2">Reset</button>
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