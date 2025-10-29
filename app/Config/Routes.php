<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Registration::index');
$routes->post('/register/submit', 'Registration::register');
$routes->get('/login', 'Login::index');
$routes->get('/api/current-user', 'UserSession::getCurrentUser');