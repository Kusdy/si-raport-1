<!DOCTYPE html>
<html
lang="en"
class="light-style layout-menu-fixed"
dir="ltr"
data-theme="theme-default"
data-assets-path="<?= base_url() ?>template/assets/"
data-template="vertical-menu-template-free"
>
<head>
	<?= $this->include('layouts/dashboard/head'); ?>
</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->
			<?= $this->include('layouts/dashboard/sidebar'); ?>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->
				<?= $this->include('layouts/dashboard/header'); ?>
				<!-- / Navbar -->

				<!-- Content -->
				<?= $this->renderSection('content'); ?>
				<!-- End Content -->

				<!-- Footer -->
				<?= $this->include('layouts/dashboard/footer'); ?>
				<!-- / Footer -->


				<div class="content-backdrop fade"></div>
			</div>
			<!-- Content wrapper -->
		</div>
		<!-- / Layout page -->
	</div>

	<!-- Overlay -->
	<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Script -->
<?= $this->include('layouts/dashboard/script'); ?>
<!-- End Script -->

</body>
</html>
