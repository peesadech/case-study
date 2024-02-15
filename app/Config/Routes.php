<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Home::register');
$routes->post('register/process','Home::registerProcess',['as'=>"register_process"]);
$routes->get('/login', 'Home::login');
$routes->post('login/process','Home::loginProcess',['as'=>"login_process"]);
