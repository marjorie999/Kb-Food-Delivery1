<?php

use CodeIgniter\Router\RouteCollection;
use \App\Controllers\Catalog;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// CRUD Routes
$routes->get('fetchFood', 'Food::index');

$routes->get('fetchFoodDetails/(:any)', 'Food::details/$1');
$routes->get('fetchOrderDetails/(:num)', 'Order::getOrderId/$1');
$routes->get('getMenu/(:num)', 'Food::getMenuDetails/$1');
$routes->post('create_menu', 'Food::create');
$routes->post('update_menu', 'Food::update');

$routes->post('orderDelivered', 'Order::orderDelivered');

$routes->get('fetchCategory', 'Category::index');

$routes->post('placeOrder', 'Order::create');

$routes->get('/fetchUser', 'Admin::index');

$routes->get('/fetchOrder', 'Admin::fetchOrderData');
$routes->get('/fetchOrdered', 'Admin::fetchOrderedFoodData');
$routes->get('/fetchOrderData', 'Admin::getJoinedOrderData');
//AUTH ROUTES
$routes->get('wow', 'Auth::index');
$routes->post('register', 'Authentication::register');
$routes->post('login', 'Authentication::login');




