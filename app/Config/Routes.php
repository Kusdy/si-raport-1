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

    //data pengguna (UDAH JADI)
    $routes->get('data-pengguna', 'Admin\UserController::index');
    $routes->get('data-pengguna/new', 'Admin\UserController::new');
    $routes->post('data-pengguna/add', 'Admin\UserController::add');
    $routes->get('data-pengguna/edit/(:num)', 'Admin\UserController::edit/$1');
    $routes->post('data-pengguna/update/(:num)', 'Admin\UserController::update/$1');
    $routes->get('data-pengguna/delete/(:num)', 'Admin\UserController::delete/$1');

    //kelola siswa
    $routes->get('kelola_siswa', 'Admin\KelSiswaController::index');
    $routes->get('kelola_siswa/edit', 'Admin\KelSiswaController::edit');

    //kelola guru
    $routes->get('kelola_guru', 'Admin\KelGuruController::index');
    $routes->get('kelola_guru/edit', 'Admin\KelGuruController::edit');

    //kelola walikelas
    $routes->get('kelola_walikelas', 'Admin\KelWalikelasController::index');
    $routes->get('kelola_walikelas/edit', 'Admin\KelWalikelasController::edit');

    //kelola kelas (UDAH JADI)
    $routes->get('kelola_kelas', 'Admin\KelKelasController::index');
    $routes->post('kelola_kelas/add', 'Admin\KelKelasController::add');
    $routes->post('kelola_kelas/update/(:num)', 'Admin\KelKelasController::update/$1');
    $routes->get('kelola_kelas/delete/(:num)', 'Admin\KelKelasController::delete/$1');

    //kelola semester (UDAH JADI)
    $routes->get('kelola_semester', 'Admin\KelSemesterController::index');
    $routes->post('kelola_semester/add', 'Admin\KelSemesterController::add');
    $routes->post('kelola_semester/update/(:num)', 'Admin\KelSemesterController::update/$1');
    $routes->get('kelola_semester/delete/(:num)', 'Admin\KelSemesterController::delete/$1');

    //kelola tahun ajar (UDAH JADI)
    $routes->get('kelola_tahun_ajar', 'Admin\KelSetTahunController::index');
    $routes->post('kelola_tahun_ajar/add', 'Admin\KelSetTahunController::add');
    $routes->post('kelola_tahun_ajar/update/(:num)', 'Admin\KelSetTahunController::update/$1');
    $routes->get('kelola_tahun_ajar/delete/(:num)', 'Admin\KelSetTahunController::delete/$1');

    //kelola mapel
    $routes->get('kelola_mapel', 'Admin\KelMapelController::index');
    $routes->get('kelola_mapel/edit', 'Admin\KelMapelController::edit');

    //kelola raport
    $routes->get('kelola_raport', 'Admin\KelRaportController::index');
    $routes->get('kelola_raport/edit', 'Admin\KelRaportController::edit');

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
