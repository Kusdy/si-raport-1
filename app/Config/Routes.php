<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth\LoginController::index');

//AUTH
$routes->get('login', 'Auth\LoginController::index');
$routes->post('login', 'Auth\LoginController::login');
$routes->get('logout', 'Auth\LoginController::logout');

// ADMIN AKSES
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
	$routes->get('dashboard', 'Admin\DashboardController::index');
});

// GURU AKSES
$routes->group('guru', ['filter' => 'auth'], function ($routes) {
	$routes->get('dashboard', 'Guru\DashboardController::index');
});

// SISWA AKSES
$routes->group('siswa', ['filter' => 'auth'], function ($routes) {
	$routes->get('dashboard', 'Siswa\DashboardController::index');
});

// WALI KELAS AKSES
$routes->group('wakel', ['filter' => 'auth'], function ($routes) {
	$routes->get('dashboard', 'Wakel\DashboardController::index');
});

// KEPALA SEKOLAH AKSES
$routes->group('kepsek', ['filter' => 'auth'], function ($routes) {
	$routes->get('dashboard', 'Kepsek\DashboardController::index');
});
