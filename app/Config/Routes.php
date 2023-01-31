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

// Auth
$routes->get('signup', 'Signup::new');
$routes->get('signup/success', 'Signup::success');
$routes->get('login', 'Login::new');
$routes->get('logout', 'Login::delete');
$routes->get('logout/message', 'Login::showLogoutMessage');
// Auth admin
$routes->post('signup/create', 'Signup::create');
$routes->post('login/create', 'Login::create');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
