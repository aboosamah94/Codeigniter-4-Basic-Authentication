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

$routes->get('password', 'Password::redirect');
$routes->get('password/resetsent', 'Password::resetsent');
$routes->get('password/resetsuccess', 'Password::resetSuccess');
$routes->get('password/reset/(:any)', 'Password::reset/$1');
$routes->get('login/forgot', 'Password::forgot', ['filter' => 'guest']);

// Auth admin
$routes->post('signup/create', 'Signup::create');
$routes->post('login/create', 'Login::create');
$routes->post('password/processForgot', 'Password::processForgot');
$routes->post('password/processReset/(:any)', 'Password::processReset/$1');

// Users
$routes->get('dashboard/users', 'Admin\Users::index');
$routes->get('dashboard/users/(:num)', 'Admin\Users::show/$1');
$routes->get('dashboard/users/new', 'Admin\Users::new');
$routes->get('dashboard/users/edit/(:num)', 'Admin\Users::edit/$1');

// Users admin
$routes->post('dashboard/users/create', 'Admin\Users::create');
$routes->post('dashboard/users/update/(:num)', 'Admin\Users::update/$1');
$routes->get('dashboard/users/delete/(:num)', 'Admin\Users::delete/$1');

// User
$routes->get('dashboard/profile', 'Profile::show');
$routes->get('dashboard/profile/image', 'Profile::image');
$routes->get('dashboard/profile/edit', 'Profile::edit');
$routes->get('dashboard/profile/editpassword', 'Profile::editPassword');
$routes->get('dashboard/profile/authenticate', 'Profile::authenticate');

$routes->get('dashboard/profile/profileimage/edit', 'profileimage::edit');
$routes->get('dashboard/profile/profileimage/delete', 'profileimage::delete');

$routes->post('dashboard/profile/update', 'Profile::update');
$routes->post('dashboard/profile/updatepassword', 'Profile::updatepassword');
$routes->post('dashboard/profile/processauthenticate', 'Profile::processauthenticate');

$routes->post('dashboard/profile/profileimage/update', 'profileimage::update');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
