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
});


$routes->group('user', function ($routes) {
    $routes->get('/', 'user\AuthController::index');
    $routes->post('login', 'user\AuthController::auth');
    $routes->get('register', 'user\AuthController::register');
    $routes->get('dashboard', 'user\DashboardController::index');
    $routes->get('pesan-tiket', 'user\PesanTiketController::index');
    $routes->get('pesan-tiket/success/(:any)', 'user\PesanTiketController::success/$1');
    $routes->post('pesan-tiket/update', 'user\PesanTiketController::update');
    $routes->post('pesan-tiket', 'user\PesanTiketController::store');
    $routes->post('pesan-tiket/cek', 'user\PesanTiketController::cekTiket');

    $routes->get('riwayat', 'user\RiwayatController::index');
    $routes->get('riwayat/tiket/(:any)', 'user\RiwayatController::tiket/$1');
});
