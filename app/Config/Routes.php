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

    //data pengguna
    $routes->get('data-pengguna', 'Admin\UserController::index');
    $routes->get('data-pengguna/new', 'Admin\UserController::tambah');
    $routes->post('data-pengguna/add', 'Admin\UserController::prosesTambah');
    $routes->get('data-pengguna/edit/(:num)', 'Admin\UserController::edit/$1');
    $routes->post('data-pengguna/update/(:num)', 'Admin\UserController::update/$1');
    $routes->get('data-pengguna/delete/(:num)', 'Admin\UserController::delete/$1');

    //kelola siswa
    $routes->get('kelola_siswa', 'Admin\KelSiswaController::index');
    $routes->get('kelola_siswa/new', 'Admin\KelSiswaController::new');
    $routes->post('kelola_siswa/add', 'Admin\KelSiswaController::add');
    $routes->get('kelola_siswa/edit/(:num)', 'Admin\KelSiswaController::edit/$1');
    $routes->post('kelola_siswa/update/(:num)', 'Admin\KelSiswaController::update/$1');
    $routes->get('kelola_siswa/delete/(:num)', 'Admin\KelSiswaController::delete/$1');

    //kelola guru
    $routes->get('kelola_guru', 'Admin\KelGuruController::index');
    $routes->get('kelola_guru/new', 'Admin\KelGuruController::new');
    $routes->post('kelola_guru/add', 'Admin\KelGuruController::add');
    $routes->get('kelola_guru/edit/(:num)', 'Admin\KelGuruController::edit/$1');
    $routes->post('kelola_guru/update/(:num)', 'Admin\KelGuruController::update/$1');
    $routes->get('kelola_guru/delete/(:num)', 'Admin\KelGuruController::delete/$1');

    //kelola walikelas
    $routes->get('kelola_walikelas', 'Admin\KelWalikelasController::index');
    $routes->get('kelola_walikelas/new', 'Admin\KelWalikelasController::new');
    $routes->post('kelola_walikelas/add', 'Admin\KelWalikelasController::add');
    $routes->get('kelola_walikelas/edit/(:num)', 'Admin\KelWalikelasController::edit/$1');
    $routes->post('kelola_walikelas/update/(:num)', 'Admin\KelWalikelasController::update/$1');
    $routes->get('kelola_walikelas/delete/(:num)', 'Admin\KelWalikelasController::delete/$1');

    //kelola kelas
    $routes->get('kelola_kelas', 'Admin\KelKelasController::index');
    $routes->get('kelola_kelas/edit', 'Admin\KelkelasController::edit');

    //kelola mapel
    $routes->get('kelola_mapel', 'Admin\KelMapelController::index');

    //kelola raport
    $routes->get('kelola_raport', 'Admin\KelRaportController::index');

    //kelola KD
    $routes->get('kelola_kd', 'Admin\KelKdController::index');

    //kelola set tahun ajar
    $routes->get('kelola_set_tahun', 'Admin\KelSetTahunController::index');

    //kelola set kelas
    $routes->get('kelola_set_kelas', 'Admin\KelSetKelasController::index');

    //kelola set mapel
    $routes->get('kelola_set_mapel', 'Admin\KelSetMapelController::index');
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