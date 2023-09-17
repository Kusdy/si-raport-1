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
									<a href="<?= base_url('admin/kelola_kd/edit/' . $item['id_kd']) ?>" class="btn btn-warning btn-sm btn-circle"> <i class="nav-icon fas fa-edit"></i>
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
<?php endforeach; ?>
<!-- End Modal Hapus -->

<?= $this->endSection(); ?>