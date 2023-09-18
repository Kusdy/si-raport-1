<meta charset="utf-8" />
<meta
name="viewport"
content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
/>

<title><?= env('app.name') ?> <?= $title ?></title>

<meta name="description" content="" />

<!-- Canonical SEO -->
<link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="<?= base_url() ?>template/assets/img/favicon/favicon.ico" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
rel="stylesheet"
/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="<?= base_url() ?>template/assets/vendors/fonts/boxicons.css" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<!-- Core CSS -->
<link rel="stylesheet" href="<?= base_url() ?>template/assets/vendors/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="<?= base_url() ?>template/assets/vendors/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="<?= base_url() ?>template/assets/css/demo.css" />

<!-- Vendorss CSS -->
<link rel="stylesheet" href="<?= base_url() ?>template/assets/vendors/libs/perfect-scrollbar/perfect-scrollbar.css" />

<link rel="stylesheet" href="<?= base_url() ?>template/assets/vendors/libs/apex-charts/apex-charts.css" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="<?= base_url() ?>template/assets/vendors/js/helpers.js"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
	<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	<script src="<?= base_url() ?>template/assets/js/config.js"></script>

	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'GA_MEASUREMENT_ID');
	</script>