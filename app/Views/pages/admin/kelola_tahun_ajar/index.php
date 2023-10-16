<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-2">
			<span class="text-muted fw-light">Dashboard /</span> Kelola Tahun Ajaran
		</h4>
		<?= $this->include('components/alerts'); ?>
		<div class="card">
			<div style="position: relative;">
				<a href="#" type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary" style="position: absolute; top: 20px; right: 20px;">
					<span class="tf-icons bx bx-plus-circle"></span>&nbsp; Tambah Tahun Ajaran
				</a>
			</div>
			<h5 class="card-header">Data Set Tahun Ajaran</h5>
			<div class="table-responsive text-nowrap">
				<table class="table table-striped">
					<thead class="table-light">
						<tr>
							<th>No</th>
							<th class="text-center">Semester</th>
							<th class="text-center">Tahun Ajaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody class="table-border-bottom-0">
						<?php $counter = 1; ?>
						<?php foreach ($tahun as $item) : ?>
							<tr>
								<td><?= $counter++ ?></td>
								<td class="table-plus text-center">Semester <?= $item['semester'] . ' - ' . $item['ket_semester'] ?></td>
								<td align="center"><span class="badge bg-label-primary me-1"><b><?= $item['tahun']; ?></b></span></td>
								<td>
									<div class="dropdown">
										<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
										<div class="dropdown-menu">
											<a href="javascript:void(0);" type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-<?= $item['id_thn_ajar'] ?>"><i class="bx bx-edit-alt me-2"></i> Edit</a>
											<a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapus-<?= $item['id_thn_ajar'] ?>" data-delete-url="<?= base_url('admin/kelola_tahun_ajar/delete/' . $item['id_thn_ajar']) ?>"><i class="bx bx-trash me-2"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Tambah Data Semester</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('admin/kelola_tahun_ajar/add') ?>" method="POST">
				<div class="modal-body">
					<div class="col mb-3">
						<label for="semester" class="form-label">semester</label>
						<select id="semester" name="id_semester" class="select2 form-select" required>
							<option selected disabled>--Pilih Semester--</option>
							<?php foreach ($semesterData as $semester) : ?>
								<option value="<?= $semester['id_semester']; ?>">
									<?= $semester['semester'] . ' - ' . $semester['ket_semester']; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col mb-0">
						<label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
						<input class="form-control" type="hidden" id="tahun" name="tahun" required />
						<div class="input-group">
							<input class="form-control" type="text" id="tahun_awal" name="tahun_awal" placeholder="Tahun Awal" required />
							<span class="input-group-text">/</span>
							<input class="form-control" type="text" id="tahun_akhir" name="tahun_akhir" placeholder="Tahun Akhir" required />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach ($tahun as $key => $item) : ?>
	<div class="modal fade" id="hapus-<?= $item['id_thn_ajar'] ?>" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= base_url('admin/kelola_tahun_ajar/delete/' . $item['id_thn_ajar']) ?>">
					<div class="modal-body">
						<p>Yakin ingin menghapus data semester <b><?= $item['semester'] . ' - ' . $item['ket_semester'] ?></b> tahun ajaran <b>(<?= $item['tahun']; ?>)</b>? klik hapus jika Ya!</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
						<button type="submit" class="btn btn-primary">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="edit-<?= $item['id_thn_ajar'] ?>" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel1">Tambah Data Tahun Ajaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= base_url('admin/kelola_tahun_ajar/update/' . $item['id_thn_ajar']) ?>" method="POST">
					<div class="modal-body">
						<div class="col mb-3">
							<label for="semester" class="form-label">semester</label>
							<select id="semester" name="id_semester" class="select2 form-select" required>
								<option selected disabled>--Pilih Semester--</option>
								<?php foreach ($semesterData as $semester) : ?>
									<option value="<?= $semester['id_semester']; ?>" <?= ($semester['id_semester'] == $item['id_semester']) ? 'selected' : ''; ?>>
										<?= $semester['semester'] . ' - ' . $semester['ket_semester']; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col mb-0">
							<label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
							<input class="form-control" type="hidden" id="tahun" name="tahun" required />
							<div class="input-group">
								<input class="form-control" type="text" id="tahun_awal" name="tahun_awal" placeholder="Tahun Awal" required />
								<span class="input-group-text">/</span>
								<input class="form-control" type="text" id="tahun_akhir" name="tahun_akhir" placeholder="Tahun Akhir" required />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const form = document.getElementById('formAccountSettings');
		const tahunAjaranInput = document.getElementById('tahun');
		const tahunAwalInput = document.getElementById('tahun_awal');
		const tahunAkhirInput = document.getElementById('tahun_akhir');

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			const tahunAwal = tahunAwalInput.value;
			const tahunAkhir = tahunAkhirInput.value;
			const tahunAjaran = tahunAwal + '/' + tahunAkhir;
			tahunAjaranInput.value = tahunAjaran;
			form.submit(); 
		});
	});
</script>

<?= $this->endSection(); ?>