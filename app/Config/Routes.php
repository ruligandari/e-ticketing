<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// auth
$routes->get('/', 'admin\AuthController::index');
$routes->post('login', 'admin\AuthController::auth');
$routes->get('logout', 'admin\AuthController::logout');

$routes->group('dashboard', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('/', 'admin\DashboardController::index');
    $routes->get('kelola-tiket', 'admin\KelolaTiketController::index');
    $routes->post('kelola-tiket', 'admin\KelolaTiketController::insert');
    $routes->post('edit-kelola-tiket', 'admin\KelolaTiketController::update');
    $routes->post('hapus-kelola-tiket', 'admin\KelolaTiketController::delete');

    $routes->get('buat-tiket', 'admin\BuatTiketController::index');
    $routes->post('buat-tiket', 'admin\BuatTiketController::store');
    $routes->post('hapus-buat-tiket', 'admin\BuatTiketController::delete');

    $routes->get('cetak-tiket/(:any)', 'admin\CetakTiket::index/$1');

    $routes->get('pemesanan-tiket', 'admin\PemesananTiketController::index');
    $routes->post('pemesanan-tiket', 'admin\PemesananTiketController::update');

    $routes->get('scan-tiket', 'admin\ScanTiketController::index');
    $routes->post('scan-tiket', 'admin\ScanTiketController::scan');

    $routes->get('artikel', 'admin\ArtikelController::index');
    $routes->get('artikel/tambah', 'admin\ArtikelController::create');
    $routes->post('artikel', 'admin\ArtikelController::save');
});


$routes->group('user', function ($routes) {
    $routes->get('/', 'user\AuthController::index');
    $routes->post('login', 'user\AuthController::auth');
    $routes->get('logout', 'user\AuthController::logout');
    $routes->get('register', 'user\AuthController::register');
    $routes->post('register', 'user\AuthController::registrasi');
    // setelah login
    $routes->get('dashboard', 'user\DashboardController::index', ['filter' => 'userFilter']);
    $routes->get('pesan-tiket', 'user\PesanTiketController::index', ['filter' => 'userFilter']);
    $routes->get('pesan-tiket/success/(:any)', 'user\PesanTiketController::success/$1', ['filter' => 'userFilter']);
    $routes->post('pesan-tiket/update', 'user\PesanTiketController::update', ['filter' => 'userFilter']);
    $routes->post('pesan-tiket', 'user\PesanTiketController::store', ['filter' => 'userFilter']);
    $routes->post('pesan-tiket/cek', 'user\PesanTiketController::cekTiket', ['filter' => 'userFilter']);

    $routes->get('riwayat', 'user\RiwayatController::index', ['filter' => 'userFilter']);
    $routes->get('riwayat/tiket/(:any)', 'user\RiwayatController::tiket/$1', ['filter' => 'userFilter']);
    $routes->get('blog/(:any)', 'user\BlogController::index/$1', ['filter' => 'userFilter']);

    $routes->get('profile', 'user\ProfileController::index', ['filter' => 'userFilter']);
    $routes->get('info-aplikasi', 'user\InfoAplikasiController::index', ['filter' => 'userFilter']);
});
