<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group('dashboard', ['filter' => 'auth', 'namespace' => 'App\Modules\Dashboard\Controllers'], function ($routes) {
    $routes->get('/', 'DashboardController::index', ['as' => 'dashboard']);
});

$routes->addRedirect('/', 'dashboard');

// Modul Auth
$routes->group('auth', ['namespace' => 'App\Modules\User\Controllers'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('login', 'UserController::index');
    $routes->get('logout', 'UserController::logout');
    $routes->post('authenticate', 'UserController::authenticate');
});

// Modul Radius
$routes->group('radius', ['filter' => 'auth', 'namespace' => 'App\Modules\Radius\Controllers'], function ($routes) {
    $routes->get('/', 'MacAddressController::index');
    $routes->get('create', 'MacAddressController::create');
    $routes->post('store', 'MacAddressController::store');
    $routes->post('update/(:num)', 'MacAddressController::update/$1');
    $routes->get('edit/(:num)', 'MacAddressController::edit/$1');
    $routes->post('delete', 'MacAddressController::delete');
    $routes->post('deleteSelected', 'MacAddressController::deleteSelected');
});

// Route untuk Jenis Perangkat
$routes->group('jenis-perangkat', ['namespace' => 'App\Modules\MasterData\Controllers'], function ($routes) {
    $routes->get('/', 'JenisPerangkatController::index');
    $routes->get('create', 'JenisPerangkatController::create');
    $routes->post('store', 'JenisPerangkatController::store');
    $routes->get('edit/(:num)', 'JenisPerangkatController::edit/$1');
    $routes->post('update/(:num)', 'JenisPerangkatController::update/$1');
    $routes->post('delete/(:num)', 'JenisPerangkatController::delete/$1');
    $routes->get('displayData', 'JenisPerangkatController::displayData');
    $routes->get('displayDataExport', 'JenisPerangkatController::displayDataExport');
});

// Route untuk Merk Perangkat
$routes->group('merk-perangkat', ['namespace' => 'App\Modules\MasterData\Controllers'], function ($routes) {
    $routes->get('/', 'MerkPerangkatController::index');  // Menampilkan daftar merk perangkat
    $routes->get('create', 'MerkPerangkatController::create');  // Halaman form tambah merk perangkat
    $routes->post('store', 'MerkPerangkatController::store');   // Proses penyimpanan data baru
    $routes->get('edit/(:num)', 'MerkPerangkatController::edit/$1');  // Halaman edit data berdasarkan ID
    $routes->post('update/(:num)', 'MerkPerangkatController::update/$1');  // Proses update data
    $routes->post('delete/(:num)', 'MerkPerangkatController::delete/$1');  // Proses hapus data
    $routes->get('displayData', 'MerkPerangkatController::displayData');
    $routes->get('displayDataExport', 'MerkPerangkatController::displayDataExport');
});

// Route untuk Asset Management
$routes->group('asset-management', ['namespace' => 'App\Modules\AssetManagement\Controllers'], function ($routes) {
    $routes->get('/', 'AssetManagementController::index');
    $routes->get('displayData', 'AssetManagementController::displayData');
    $routes->get('displayDataExport', 'AssetManagementController::displayDataExport');
    $routes->get('create', 'AssetManagementController::create');
    $routes->get('edit/(:num)', 'AssetManagementController:edit/$1');
    $routes->post('store', 'AssetManagementController::store');
    $routes->post('update/(:num)', 'AssetManagementController::update/$1');
    $routes->post('delete/(:num)', 'AssetManagementController::delete/$1');
});
