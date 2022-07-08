<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/activate/(:segment)', 'AuthController::activate/$1');
$routes->get('/recover-password/(:segment)', 'AuthController::recover_view/$1');
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('/antrian', 'Admin::antrian');
$routes->get('/ambil_antrian', 'Home::ambil');
$routes->get('/antrian_next/(:any)', 'Admin::antrian_next/$1');

$routes->get('/laporan', 'Admin::laporan');
$routes->get('/laporan_hapus/(:any)', 'Admin::laporan_hapus/$1');

$routes->get('/loket', 'Admin::loket');
$routes->add('/loket_tambah', 'Admin::loket_tambah');
$routes->add('/loket_edit/(:any)', 'Admin::loket_edit/$1');
$routes->add('/loket_hapus/(:any)', 'Admin::loket_hapus/$1');

$routes->get('/agenda', 'Admin::agenda');
$routes->get('/agenda_tambah', 'Admin::agenda_tambah');
$routes->get('/agenda_edit/(:any)', 'Admin::agenda_edit/$1');
$routes->get('/agenda_hapus/(:any)', 'Admin::agenda_hapus/$1');

$routes->get('/pelayan', 'Admin::pelayan');
$routes->get('/pelayan_tambah', 'Admin::pelayan_tambah');
$routes->get('/pelayan_edit/(:any)', 'Admin::pelayan_edit/$1');
$routes->get('/pelayan_hapus/(:any)', 'Admin::pelayan_hapus/$1');

$routes->get('/login', function () {
	return view('auth/login');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
