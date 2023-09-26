<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="index.html" class="app-brand-link">
			<span class="app-brand-logo demo">
				<img src="<?= base_url() ?>template/assets/img/school.png" alt="" style="width: 30px;">
			</span>
			<span class="demo menu-text fw-bolder ms-2" style="font-size: 25px;">SI Raport</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Dashboard -->
		<li class="menu-item <?= ($active == 'dashboard') ? 'active' : '' ?>">
			<a href="<?= base_url('guru/dashboard') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Analytics">Dashboard</div>
			</a>
		</li>

		<!-- Components -->
		<li class="menu-header small text-uppercase"><span class="menu-header-text">Kelola Data</span></li>
		<!-- Cards -->
		<li class="menu-item <?= ($active == 'kelas') ? 'active' : '' ?>">
			<a href="<?= base_url('guru/kelas') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-graduation"></i>
				<div data-i18n="Basic">Kelas</div>
			</a>
		</li>
		<li class="menu-item <?= ($active == 'Nilai') ? 'active' : '' ?>">
			<a href="<?= base_url('guru/nilai') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-file"></i>
				<div data-i18n="Basic">Nilai</div>
			</a>
		</li>
		<li class="menu-item <?= ($active == 'raport') ? 'active' : '' ?>">
			<a href="<?= base_url('guru/kelola_raport') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-collection"></i>
				<div data-i18n="Basic">Raport (Belum)</div>
			</a>
		</li>
	</ul>
</aside>