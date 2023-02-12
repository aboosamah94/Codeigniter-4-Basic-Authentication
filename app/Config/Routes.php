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


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */


// HOME
$routes->get('/', 'Home::index');

$routes->get('sendtest', 'Home::testEmail');

// Auth
$routes->get('signup', 'Signup::new', ['filter' => 'guest']);
$routes->get('emailactivate/(:any)', 'Signup::activate/$1');
$routes->get('signup/success', 'Signup::success', ['filter' => 'guest']);

$routes->get('login', 'Login::new', ['filter' => 'guest']);

$routes->get('logout', 'Login::delete');
$routes->get('logout/message', 'Login::showLogoutMessage');
// Auth admin
$routes->post('signup/create', 'Signup::create');
$routes->post('login/create', 'Login::create');

// Users
$routes->get('dashboard/users', 'Admin\Users::index');
$routes->get('dashboard/users/(:num)', 'Admin\Users::show/$1');
$routes->get('dashboard/users/new', 'Admin\Users::new');
$routes->get('dashboard/users/edit/(:num)', 'Admin\Users::edit/$1');

// Users admin
$routes->post('dashboard/users/create', 'Admin\Users::create');
$routes->post('dashboard/users/update/(:num)', 'Admin\Users::update/$1');
$routes->get('dashboard/users/delete/(:num)', 'Admin\Users::delete/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
