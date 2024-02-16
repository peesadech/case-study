<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['filter' => 'authFilter'],['as'=>"home"]);
//$routes->get('/', 'Home::index',['filter' => 'authCheck'],['as'=>"home"]);
$routes->get('/dashboard', 'Home::dashboard',['filter' => 'authFilter'],['as'=>"dashboard"]);
//$routes->get('/dashboard', 'Home::dashboard',['filter' => 'authCheck'],['as'=>"dashboard"]);
$routes->get('/register', 'Home::register');
$routes->post('register/process','Home::registerProcess',['as'=>"register_process"]);
//$routes->get('/login', 'Home::login',['filter' => 'authFilter']);
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->post('login/process','Home::loginProcess',['as'=>"login_process"]);

// $routes->group('',['filter' => 'AuthCheck'], function ($routes) {
//     $routes->get('dashboard', 'Dashboard::index');
//  });
//  $routes->group('',['filter' => 'AlreadyLoggedIn'], function ($routes) {
//      $routes->get('auth', 'Auth::index');
//      $routes->get('auth/register', 'Auth::register');
//  });
