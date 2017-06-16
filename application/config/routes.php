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
/*

 ADMIN


 */
$route['dang-nhap'] = "admin_login/login";
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

$route['quan-tri/danh-muc-san-pham'] = "admin_products/catalog";
$route['quan-tri/danh-muc-san-pham/add'] = "admin_products/catalog/add";
$route['quan-tri/danh-muc-san-pham/edit/(:num)'] = "admin_products/catalog/edit/$1";
$route['quan-tri/danh-muc-san-pham/delete/(:num)'] = "admin_products/catalog/delete/$1";
$route['quan-tri/danh-muc-san-pham/deleteall'] = "admin_products/catalog/deleteall";

$route['quan-tri/san-pham'] = "admin_products/products";
$route['quan-tri/san-pham/(:num)'] = "admin_products/products/index/$1";
$route['quan-tri/san-pham/add'] = "admin_products/products/add";
$route['quan-tri/san-pham/edit/(:num)'] = "admin_products/products/edit/$1";
$route['quan-tri/san-pham/delete/(:num)'] = "admin_products/products/delete/$1";
$route['quan-tri/san-pham/deleteall'] = "admin_products/products/deleteall";

/* Tin tức */

$route['quan-tri/tin-tuc'] = "admin_news/news";
$route['quan-tri/tin-tuc/(:num)'] = "admin_news/news/index/$1";
$route['quan-tri/tin-tuc/add'] = "admin_news/news/add";
$route['quan-tri/tin-tuc/edit/(:num)'] = "admin_news/news/edit/$1";
$route['quan-tri/tin-tuc/delete/(:num)'] = "admin_news/news/delete/$1";
$route['quan-tri/tin-tuc/deleteall'] = "admin_news/news/deleteall";

/* Đơn hàng */

$route['quan-tri/don-hang'] = "admin_order/orders";
$route['quan-tri/don-hang/(:num)'] = "admin_order/orders/index/$1";
$route['quan-tri/don-hang/add'] = "admin_order/orders/add";
$route['quan-tri/don-hang/edit/(:num)'] = "admin_order/orders/edit/$1";
$route['quan-tri/don-hang/delete/(:num)'] = "admin_order/orders/delete/$1";
$route['quan-tri/don-hang/deleteall'] = "admin_order/orders/deleteall";
 

/* Slider */
$route['quan-tri/slide'] = "admin_slide/slide";
$route['quan-tri/slide/(:num)'] = "admin_slide/slide/index/$1";
$route['quan-tri/slide/add'] = "admin_slide/slide/add";
$route['quan-tri/slide/edit/(:num)'] = "admin_slide/slide/edit/$1";
$route['quan-tri/slide/delete/(:num)'] = "admin_slide/slide/delete/$1";
$route['quan-tri/slide/deleteall'] = "admin_slide/slide/deleteall";


/*

FRONT-END

*/


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
