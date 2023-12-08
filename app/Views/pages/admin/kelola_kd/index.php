<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4">
			<span class="text-muted fw-light">Dashboard /</span> Data Kompetensi Dasar
		</h4>
		<!-- Basic Bootstrap Table -->
		<?= $this->include('components/alerts'); ?>
		<div class="card">
			<div class="card-header">
				<div class="add-button-container">
					<h5>Data Kompetensi Dasar</h5>
					<a href="<?= base_url('admin/kelola_kd/new'); ?>" class="btn btn-primary add-button">
						<span class="tf-icons bx bx-plus-circle"></span>&nbsp;Tambah KD
					</a>
				</div>
			</div>
			<div class="table-responsive text-nowrap">
				<table class="table table-striped">
					<thead class="table-light">
						<tr>
							<th>No</th>
							<th>Mapel</th>
							<th>Indikator</th>
							<th>Deskripsi</th>
							<th>Penilaian</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody class="table-border-bottom-0">
						<?php $i=1; ?>
						<?php foreach($dataKd as $item) : ?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $item['mata_pelajaran'] . ' - ' . $item['id_kelas'] ?></td>
								<td><?= $item['indikator_kd'] ?></td>
								<td><?= $item['deskripsi_kd'] ?></td>
								<td><?= $item['penilaian'] ?></td>
								<td>
									<a href="<?= base_url('admin/kelola_kd/edit/' . $item['id_kd']) ?>" class="btn btn-warning btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#edit-<?= $item['id_kd'] ?>"> <i class="nav-icon fas fa-edit"></i>
									</a>
									<a href="<?= base_url('admin/kelola_kd/delete/' . $item['id_kd']) ?>" class="btn btn-danger btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#hapus-<?= $item['id_kd'] ?>" data-delete-url="<?= base_url('admin/kelola_kd/delete/' . $item['id_kd']) ?>">
										<i class="nav-icon fas fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="demo-inline-spacing">
			<nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
				<ul class="pagination">
					<!-- JS -->
				</ul>
				<select class="form-select" id="items-per-page" style="width: 73px;">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="75">75</option>
					<option value="100">100</option>
				</select>
			</nav>
		</div>
	</div>
</div>

<!-- Modal Hapus -->
<?php foreach ($dataKd as $key => $item) : ?>
	<div class="modal fade" id="hapus-<?= $item['id_kd'] ?>" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel1">Konfirmasi Penghapusan Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= base_url('admin/kelola_kd/delete/' . $item['id_kd']) ?>">
					<div class="modal-body">
						<p>Yakin ingin menghapus data KD ini?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Kembali</button>
						<button type="submit" class="btn btn-primary">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End Modal Hapus -->

	<!-- Modal Edit -->
	<div class="modal fade" id="edit-<?= $item['id_kd'] ?>" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel1">Edit Kompetensi Dasar</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= base_url('admin/kelola_kd/update/' . $item['id_kd']) ?>" method="POST">
					<div class="modal-body">
						<div class="col mb-3">
							<label for="semester" class="form-label">Mata Pelajaran</label>
							<select id="semester" name="id_mapel" class="select2 form-select" required>
								<option selected disabled>--Pilih Mata Pelajaran--</option>
								<?php foreach ($dataMapel as $mapel) : ?>
									<option value="<?= $mapel['id_mapel']; ?>" <?= ($mapel['id_mapel'] == $item['id_mapel']) ? 'selected' : ''; ?>>
										<?= $mapel['mata_pelajaran'] . ' - ' . $mapel['id_kelas']; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="col mb-3">
							<label for="indikator_kd" class="form-label">Indikator</label>
							<select id="indikator_kd" name="indikator_kd" class="select2 form-select" required>
								<option disabled>--Pilih Indikator KD--</option>
								<option <?= $item['indikator_kd'] == 'Indikator 1' ? 'selected' : '' ?>>Indikator 1</option>
								<option <?= $item['indikator_kd'] == 'Indikator 2' ? 'selected' : '' ?>>Indikator 2</option>
								<option <?= $item['indikator_kd'] == 'Indikator 3' ? 'selected' : '' ?>>Indikator 3</option>
								<option <?= $item['indikator_kd'] == 'Indikator 4' ? 'selected' : '' ?>>Indikator 4</option>
							</select>
						</div>

						<div class="col mb-3">
							<label for="deskripsi" class="form-label">Deskripsi</label>
							<textarea class="form-control" rows="2" name="deskripsi_kd"><?= $item['deskripsi_kd'] ?></textarea>
						</div>

						<div class="col mb-3">
							<label for="materi_pembelajaran" class="form-label">Materi Pembelajaran</label>
							<textarea class="form-control" rows="2" name="materi_pembelajaran"><?= $item['materi_pembelajaran'] ?></textarea>
						</div>

						<div class="col mb-3">
							<label for="penilaian" class="form-label">Penilaian</label>
							<textarea class="form-control" rows="2" name="penilaian"><?= $item['penilaian'] ?></textarea>
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
	<!-- End Modal Edit -->
<?php endforeach; ?>

<?= $this->endSection(); ?>