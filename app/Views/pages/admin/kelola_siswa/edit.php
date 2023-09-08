<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Forms /</span> Tambah Siswa
        </h4>
        <div class="col-xl-12 mx-auto">
            <!-- HTML5 Inputs -->
            <div class="card mb-4">
                <h5 class="card-header">HTML5 Inputs</h5>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Nama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="Sneat" id="html5-text-input" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-number-input" class="col-md-2 col-form-label">NIS</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" value="18" id="html5-number-input" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="largeSelect" class="col-md-2 col-form-label">Kelas</label>
                        <div class="col-md-10">
                            <select id="largeSelect" class="form-select">
                                <option selected disabled>Pilih Kelas</option>
                                <option value="1">XI</option>
                                <option value="2">XII</option>
                                <option value="3">IX</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="largeSelect" class="col-md-2 col-form-label">Tahun Ajar</label>
                        <div class="col-md-10">
                            <select id="largeSelect" class="form-select">
                                <option selected disabled>Pilih Tahun Ajar</option>
                                <option value="1">XI</option>
                                <option value="2">XII</option>
                                <option value="3">IX</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="largeSelect" class="col-md-2 col-form-label">Foto</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="file" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="largeSelect" class="col-md-2 col-form-label"></label>
                        <div class="col-md-10">
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>