<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('Dashboard/index/(:num)', 'Dashboard::index/$1');
$routes->post('Dashboard/editCustomer', 'Dashboard::editCustomer');
$routes->post('Dashboard/createCustomer', 'Dashboard::createCustomer');
$routes->post('Dashboard/deleteCustomer', 'Dashboard::deleteCustomer');
$routes->post('Dashboard/filterCustomer', 'Dashboard::filterCustomer');
