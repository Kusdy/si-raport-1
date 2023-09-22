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
			<a href="<?= base_url('admin/dashboard') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Analytics">Dashboard</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Data Master</span>
		</li>

		<li class="menu-item <?= ($active == 'pengguna') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/data-pengguna') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-user"></i>
				<div data-i18n="Basic">Data Users</div>
			</a>
		</li>

		<li class="menu-item <?= ($active == 'siswa' || $active == 'guru' || $active == 'walikelas') ? 'active open' : '' ?>">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons far fa-address-card fa-sm"></i>
				<div data-i18n="Account Settings">Kelola Pengguna</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item <?= ($active == 'siswa') ? 'active' : '' ?>">
					<a href="<?= base_url('admin/kelola_siswa') ?>" class="menu-link">
						<div data-i18n="Account">Kelola Siswa</div>
					</a>
				</li>
				<li class="menu-item <?= ($active == 'guru') ? 'active' : '' ?>">
					<a href="<?= base_url('admin/kelola_guru') ?>" class="menu-link">
						<div data-i18n="Notifications">Kelola Guru</div>
					</a>
				</li>
				<li class="menu-item <?= ($active == 'walikelas') ? 'active' : '' ?>">
					<a href="<?= base_url('admin/kelola_walikelas') ?>" class="menu-link">
						<div data-i18n="Connections">Kelola Walikelas</div>
					</a>
				</li>
			</ul>
		</li>

		<!-- Components -->
		<li class="menu-header small text-uppercase"><span class="menu-header-text">Kelola Data</span></li>
		<!-- Cards -->
		<li class="menu-item <?= ($active == 'kelas') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/kelola_kelas') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-graduation"></i>
				<div data-i18n="Basic">Kelola Kelas</div>
			</a>
		</li>
		<li class="menu-item <?= ($active == 'semester') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/kelola_semester') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-list-ol"></i>
				<div data-i18n="Basic">Kelola Semester</div>
			</a>
		</li>
		<li class="menu-item <?= ($active == 'tahun') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/kelola_tahun_ajar') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-book-reader"></i>
				<div data-i18n="Basic">Kelola Tahun Ajar</div>
			</a>
		</li>
		<li class="menu-item <?= ($active == 'kelola_mapel') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/kelola_mapel') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-collection"></i>
				<div data-i18n="Basic">Kelola Mapel</div>
			</a>
		</li>

		<!-- Forms & Tables -->
		<li class="menu-header small text-uppercase"><span class="menu-header-text">Set Data</span></li>
		<!-- Forms -->
		<!-- Tables -->
		<li class="menu-item <?= ($active == 'set mapel') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/kelola_set_mapel') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-table"></i>
				<div data-i18n="Tables">Kelola Set Kelas <b style="color: red;">(On Progres Bang)</b></div>
			</a>
		</li>
		<li class="menu-item <?= ($active == 'kd') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/kelola_kd') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-table"></i>
				<div data-i18n="Tables">Kelola Set KD</div>
			</a>
		</li>
		<li class="menu-item <?= ($active == 'raport') ? 'active' : '' ?>">
			<a href="<?= base_url('admin/kelola_raport') ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-collection"></i>
				<div data-i18n="Basic">Kelola Set Raport (Belum)</div>
			</a>
		</li>
		<li class="menu-header small text-uppercase"><span class="menu-header-text"></span></li>
	</ul>
</aside>