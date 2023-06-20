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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//Home
$routes->get('/', 'Home::index');
$routes->get('profile/(:any)', 'Dashboard::profile/$1');
$routes->get('pesanan/(:any)', 'Dashboard::clientPesanan/$1');
$routes->post('pesanan/bayar', 'Home::bayar');
//Auth
$routes->match(['GET', 'POST'], 'signup', 'Auth::SignUp');
$routes->match(['GET', 'POST'], 'signin', 'Auth::SignIn');
$routes->match(['GET', 'POST'], 'signin/forgot-password', 'Auth::ForgotPassword');
$routes->match(['GET', 'POST'], 'signin/recover-account/(:any)/(:any)', 'Auth::NewPassword/$1/$2');
$routes->get('signout', 'Auth::SignOut');
//Dashboard
$routes->group('dashboard', ['filter' => 'authRole'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    //Profile
    $routes->group('profile', function ($routes) {
        $routes->match(['GET', 'POST'], '(:any)', 'Dashboard::profile/$1');
    });
    //Orders
    $routes->group('pesanan', function ($routes) {
        $routes->match(['GET', 'POST'], 'saya/(:any)', 'Home::MyOrders/$1');
    });
    //List
    $routes->group('list', function ($routes) {
        //Users CRUD
        $routes->get('users', 'Dashboard::listUsers');
        $routes->get('users/delete/(:num)', 'Dashboard::deleteUsers/$1');
        $routes->match(['GET', 'POST'], 'users/add', 'Dashboard::addUsers');
        $routes->match(['GET', 'POST'], 'users/update/(:num)', 'Dashboard::updateUsers/$1');
        //Pesanan CRUD
        $routes->get('pesanan', 'Dashboard::listOrders');
        $routes->match(['GET', 'POST'], 'pesanan/detail/(:num)', 'Dashboard::updateOrders/$1');
        $routes->post('pesanan/update', 'Dashboard::updateStatus');
        //Galleries CRUD
        $routes->get('galleries', 'Dashboard::listGalleries');
        $routes->get('galleries/delete/(:num)', 'Dashboard::deleteGalleries/$1');
        $routes->match(['GET', 'POST'], 'galleries/add', 'Dashboard::addGalleries');
    });
});

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
