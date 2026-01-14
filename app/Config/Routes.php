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
$routes->post('/booking/makeBoatReservation', 'Booking::makeBoatReservation');
$routes->post('/booking/makeSlotReservation', 'Booking::makeSlotReservation');
$routes->get('/booking/getAvailableItems', 'Booking::getAvailableItems');
$routes->get('/payment/(:num)', 'Home::payment/$1');
$routes->post('/payment/process', 'Home::processPayment');
$routes->get('/my-bookings', 'Home::myBookings');
$routes->get('/admin/bookings', 'Home::allBookings', ['filter' => 'worker']);
$routes->post('/admin/bookings/cancel', 'Home::cancelBooking', ['filter' => 'worker']);