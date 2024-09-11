<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'Pages::index');

//Ref
//mengarahkan ke page create
//$routes->get('/komik/create', 'Komik::create');
$routes->get('/tpq/tpq', 'Tpq::create');
$routes->delete('/tpq/(:num)', 'Tpq::delete/$1');

//Table Kelas
$routes->get('kelas', 'Kelas::index');             // List all records (Read)
$routes->get('kelas/create', 'Kelas::create');     // Show form to create a new record (Create)
$routes->post('kelas/store', 'Kelas::store');      // Store new record in database (Create)
$routes->get('kelas/edit/(:num)', 'Kelas::edit/$1');  // Show form to edit a specific record (Read/Update)
$routes->post('kelas/update/(:num)', 'Kelas::update/$1');  // Update a specific record in database (Update)
$routes->get('kelas/delete/(:num)', 'Kelas::delete/$1');  // Delete a specific record from database (Delete)

/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
