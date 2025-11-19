<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Registration::index');
$routes->post('/register/submit', 'Registration::register');
$routes->get('/login', 'Login::index');
$routes->post('/login/submit', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');
$routes->get('/api/current-user', 'ApiCurrentUser::getCurrentUser');
$routes->get('/booking', 'Booking::index');