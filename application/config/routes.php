<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = "home";
$route['quan-tri/dang-nhap'] = "admin_login/login";
$route['quan-tri/dang-xuat'] = "admin_login/login/logout";

$route['quan-tri'] = "admin_dashboard/dashboard";
$route['quan-tri/dashboard'] = "admin_dashboard/dashboard";
$route['quan-tri/quan-tri-vien'] = "admin_auth/auth";
$route['quan-tri/quan-tri-vien'] = "admin_auth/auth/index";
$route['quan-tri/quan-tri-vien/add'] = "admin_auth/auth/add";
$route['quan-tri/quan-tri-vien/edit/(:num)'] = "admin_auth/auth/edit/$1";
$route['quan-tri/quan-tri-vien/delete/(:num)'] = "admin_auth/auth/delete/$1";

/*Sản phẩm */

$route['quan-tri/danh-muc-san-pham'] = "products/catalog";
$route['quan-tri/danh-muc-san-pham/add'] = "products/catalog/add";
$route['quan-tri/danh-muc-san-pham/edit/(:num)'] = "products/catalog/edit/$1";
$route['quan-tri/danh-muc-san-pham/delete/(:num)'] = "products/catalog/delete/$1";
$route['quan-tri/danh-muc-san-pham/deleteall'] = "products/catalog/deleteall";

$route['quan-tri/san-pham'] = "products/products";
$route['quan-tri/san-pham/(:num)'] = "products/products/index/$1";
$route['quan-tri/san-pham/add'] = "products/products/add";
$route['quan-tri/san-pham/edit/(:num)'] = "products/products/edit/$1";
$route['quan-tri/san-pham/delete/(:num)'] = "products/products/delete/$1";
$route['quan-tri/san-pham/deleteall'] = "products/products/deleteall";




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
