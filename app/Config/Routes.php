<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->get('logout', 'Auth::logout');
$routes->group('', ['filter'=>'auth'], static function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('products', 'Products::index'); $routes->match(['get','post'],'products/new','Products::create'); $routes->match(['get','post'],'products/edit/(:num)','Products::edit/$1'); $routes->get('products/delete/(:num)','Products::delete/$1');
    $routes->get('customers', 'Customers::index'); $routes->match(['get','post'],'customers/new','Customers::create'); $routes->match(['get','post'],'customers/edit/(:num)','Customers::edit/$1'); $routes->get('customers/delete/(:num)','Customers::delete/$1');
    $routes->get('staff', 'Users::index'); $routes->match(['get','post'],'staff/new','Users::create'); $routes->match(['get','post'],'staff/edit/(:num)','Users::edit/$1'); $routes->get('staff/delete/(:num)','Users::delete/$1');
    $routes->match(['get','post'],'sales/new','Sales::create'); $routes->get('sales','Sales::index');
});
