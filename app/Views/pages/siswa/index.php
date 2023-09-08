<?= $this->extend('layouts/dashboard/main'); ?>
<?= $this->section('content'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12 mb-4 order-0">
				<div class="card">
					<div class="d-flex align-items-end row">
						<div class="col-sm-7">
							<div class="card-body">
								<h5 class="card-title text-primary">Selamat Datang <?= session()->get('nama') ?>! 🎉</h5>
								<p class="mb-4">
									Anda masuk sebagai <span class="fw-bold"><?= session()->get('role') ?>.</span>
								</p>
							</div>
						</div>
						<div class="col-sm-5 text-center text-sm-left">
							<div class="card-body pb-0 px-0 px-md-4">
								<img src="<?= base_url() ?>template/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 order-1">
				<div class="row">
					<div class="col-lg-3 col-md-12 col-6 mb-4">
						<div class="card shadow-lg">
							<div class="card-body">
								<div class="card-title d-flex align-items-start justify-content-between">
									<span>Data Pengguna</span>
									<div class="dropdown">
										<button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-2x text-primary"></i></button>
										<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
											<a class="dropdown-item" href="javascript:void(0);">View More</a>
											<a class="dropdown-item" href="javascript:void(0);">Delete</a>
										</div>
									</div>
								</div>
								<h3 class="card-title text-nowrap mb-1"><?= count($user) ?> Data</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>