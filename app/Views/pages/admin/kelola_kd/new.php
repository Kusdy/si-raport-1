<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4">
			<span class="text-muted fw-light">Kelola Kompetensi Dasar /</span> Tambah Kompetensi Dasar
		</h4>
		<div class="col-xxl">
			<?= $this->include('components/alerts'); ?>
			<div class="card mb-4">
				<div class="card-header">
					<div class="add-button-container">
						<h5>Form Input KD</h5>
						<a href="#" class="btn btn-primary add-button" id="add-kd-button">
							<span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Form
						</a>
					</div>
				</div>
				<div class="card-body">
					<form action="<?= base_url('admin/kelola_kd/add') ?>" method="post" enctype="multipart/form-data">
						<div id="form-container">
							<div id="kd-form-template">
								<div class="row mb-3">
									<div class="col mb-0 mt-0 col-md-2">
										<label for="mata_pelajaran" class="form-label">Pilih Mapel</label>
										<select class="form-select" name="id_mapel[]">
											<option selected disabled>Pilih Mapel</option>
											<?php foreach ($dataMapel as $item): ?>
												<option value="<?= $item['id_mapel'] ?>"><?= $item['mata_pelajaran'] ?> - <?= $item['id_kelas'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col mb-0 mt-0 col-md-2">
										<label for="mata_pelajaran" class="form-label">Pilih Indikator</label>
										<select class="form-select" name="indikator_kd[]">
											<option selected disabled>Pilih Indikator</option>
											<option>Indikator 1</option>
											<option>Indikator 2</option>
											<option>Indikator 3</option>
											<option>Indikator 4</option>
										</select>
									</div>
									<div class="col mb-0 mt-0 col-md-3">
										<label for="mata_pelajaran" class="form-label">Deskripsi</label>
										<textarea class="form-control" rows="1" name="deskripsi_kd[]"></textarea>
									</div>
									<div class="col mb-0 mt-0 col-md-3">
										<label for="mata_pelajaran" class="form-label">Materi Pembelajaran</label>
										<textarea class="form-control" rows="1" name="materi_pembelajaran[]"></textarea>
									</div>
									<div class="col mb-0 mt-0 col-md-2">
										<label for="mata_pelajaran" class="form-label">Penilaian</label>
										<textarea class="form-control" rows="1" name="penilaian[]"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="mt-4">
							<button type="submit" class="btn btn-primary me-2">Simpan</button>
							<button type="reset" class="btn btn-danger me-2">Reset</button>
							<a type="button" href="<?= base_url('admin/kelola_kd') ?>" class="btn btn-warning">Back</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function () {
		const addButton = document.getElementById("add-kd-button");
		const kdFormTemplate = document.getElementById("kd-form-template");
		const formContainer = document.getElementById("form-container");

		let formCount = 1;

		addButton.addEventListener("click", function (e) {
			e.preventDefault();

			const newForm = kdFormTemplate.cloneNode(true);
			newForm.style.display = "block";

			newForm.querySelectorAll("textarea").forEach((textarea) => {
				textarea.value = "";
			});

			newForm.querySelectorAll("input, select").forEach((input) => {
				input.name += "_" + formCount;
			});

			formContainer.appendChild(newForm);

			formCount++;
		});
	});

</script>

<?= $this->endSection(); ?>