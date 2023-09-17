<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">

	<!-- Content -->

	<div class="container-xxl flex-grow-1 container-p-y">


		<h4 class="fw-bold py-3 mb-2">
			<span class="text-muted fw-light">Data Pengguna /</span> Tambah Data Pengguna
		</h4>
		<div class="row">
			<div class="col-md-12">
				<?= $this->include('components/alerts'); ?>
				<div class="card mb-4">
					<hr class="my-0">
					<div class="card-body">
						<form id="formAccountSettings" action="<?= base_url('admin/data-pengguna/update/' . $user['id_user']) ?>" method="POST">
							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Nama Lengkap</label>
									<input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Lengkap" autofocus required value="<?= $user['nama'] ?>" />
								</div>
								<div class="mb-3 col-md-6">
									<label for="email" class="form-label">E-mail</label>
									<input class="form-control" type="email" id="email" name="email" placeholder="Email Aktif" required value="<?= $user['email'] ?>" />
								</div>
								<div class="mb-3 col-md-6">
									<label class="form-label" for="password">Password</label>
									<div class="input-group input-group-merge">
										<input type="password" id="password" name="password" class="form-control" placeholder="password" value="<?= str_repeat('*', min(strlen($user['password']), 8)) ?>" disabled />
										<!-- <span class="input-group-text cursor-pointer" id="password-toggle"><i class="bx bx-hide"></i></span> -->
									</div>
								</div>
								<div class="mb-3 col-md-6">
									<label for="role" class="form-label">Role</label>
									<select id="role" name="role" class="select2 form-select" required>
										<option disabled>--Pilih Role--</option>
										<option <?= $user['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
										<option <?= $user['role'] == 'Kepala sekolah' ? 'selected' : '' ?>>Kepala sekolah</option>
										<option <?= $user['role'] == 'Guru' ? 'selected' : '' ?>>Guru</option>
										<option <?= $user['role'] == 'Wali kelas' ? 'selected' : '' ?>>Wali kelas</option>
										<option <?= $user['role'] == 'Siswa' ? 'selected' : '' ?>>Siswa</option>
									</select>
								</div>
							</div>
							<div class="mt-2">
								<button type="submit" class="btn btn-primary me-2">Simpan</button>
								<button type="reset" class="btn btn-danger me-2">Reset</button>
								<a type="button" href="<?= base_url('admin/data-pengguna') ?>" class="btn btn-warning">Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const passwordInput = document.getElementById('password');
		const passwordToggle = document.getElementById('password-toggle');
		const eyeIcon = passwordToggle.querySelector('i');

		passwordToggle.addEventListener('click', function() {
			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
				eyeIcon.classList.remove('bx-hide');
				eyeIcon.classList.add('bx-show');
			} else {
				passwordInput.type = 'password';
				eyeIcon.classList.remove('bx-show');
				eyeIcon.classList.add('bx-hide');
			}
		});
	});
</script>


<?= $this->endSection(); ?>