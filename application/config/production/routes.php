<?php

defined('BASEPATH') or exit('No direct script access allowed');



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

require_once(BASEPATH .'database/DB'. EXT);

// AUTH PAGE
$route['landing']  = 'auth/controller_ctl/base/landing';

$route['login']  = 'auth/controller_ctl/base/login';

$route['register']  = 'auth/controller_ctl/base/register';

$route['auth_function']  = 'auth/function_ctl';

$route['auth_function/(:any)'] = 'auth/function_ctl/$1';

$route['auth_function/(:any)/(:any)'] = 'auth/function_ctl/$1/$2';

$route['logout'] = 'auth/function_ctl/logout';


// USER PAGE
$route['home']  = 'user/controller_ctl/base/home';

$route['investasi']  = 'user/controller_ctl/base/investasi';

$route['transaksi']  = 'user/controller_ctl/base/transaksi';

$route['transaksi/(:any)']  = 'user/controller_ctl/base/transaksi/$1';

$route['rekening']  = 'user/controller_ctl/base/rekening';

$route['informasi']  = 'user/controller_ctl/base/informasi';

$route['list_investasi']  = 'user/controller_ctl/base/list_investasi';

$route['profil']  = 'user/controller_ctl/base/profil';

$route['profil/ubah']  = 'user/controller_ctl/base/profil/ubah';


$route['user_function']  = 'user/function_ctl';

$route['user_function/(:any)'] = 'user/function_ctl/$1';

$route['user_function/(:any)/(:any)'] = 'user/function_ctl/$1/$2';

$route['user'] = 'user/controller_ctl/index';

$route['user/(:any)'] = 'user/controller_ctl/$1';

$route['user/(:any)/(:any)'] = 'user/controller_ctl/$1/$2';

$route['user/(:any)/(:any)/(:any)'] = 'user/controller_ctl/$1/$2/$3';

$route['user/(:any)/(:any)/(:any)/(:any)'] = 'user/controller_ctl/$1/$2/$3/$4';


$route['catatan'] = 'user/controller_ctl/base/catatan';

$route['catatan/(:any)'] = 'user/controller_ctl/base/catatan/$1';

$route['catatan/(:any)/(:any)'] = 'user/controller_ctl/base/catatan/$1/$2';

$route['catatan/(:any)/(:any)/(:any)'] = 'user/controller_ctl/base/catatan/$1/$2/$3';


// ADMIN PAGE

$route['master'] = 'master/controller_ctl/index';

$route['master/(:any)'] = 'master/controller_ctl/$1';

$route['master/(:any)/(:any)'] = 'master/controller_ctl/$1/$2';

$route['master/(:any)/(:any)/(:any)'] = 'master/controller_ctl/$1/$2/$3';

$route['master_function']  = 'master/function_ctl';

$route['master_function/(:any)'] = 'master/function_ctl/$1';

$route['master_function/(:any)/(:any)'] = 'master/function_ctl/$1/$2';


$route['setting']  = 'setting/controller_ctl';

$route['setting/(:any)'] = 'setting/controller_ctl/$1';

$route['setting/(:any)/(:any)'] = 'setting/controller_ctl/$1/$2';

$route['setting_function']  = 'setting/function_ctl';

$route['setting_function/(:any)'] = 'setting/function_ctl/$1';

$route['setting_function/(:any)/(:any)'] = 'setting/function_ctl/$1/$2';


$route['profile']  = 'setting/controller_ctl/profil';

$route['profile/(:any)'] = 'setting/controller_ctl/profil/$1';

$route['profile/(:any)/(:any)'] = 'setting/controller_ctl/profil/$1/$2';


$route['dashboard']  = 'dashboard/controller_ctl/index';

$route['dashboard/(:any)'] = 'dashboard/controller_ctl/$1';

$route['dashboard/(:any)/(:any)'] = 'dashboard/controller_ctl/$1/$2';

$route['dashboard_function']  = 'dashboard/function_ctl/index';

$route['dashboard_function/(:any)'] = 'dashboard/function_ctl/$1';

$route['dashboard_function/(:any)/(:any)'] = 'dashboard/function_ctl/$1/$2';

$route['penarikan']  = 'dashboard/controller_ctl/penarikan';


$route['report/(:any)'] = 'report/controller_ctl/$1';

$route['report/(:any)/(:any)'] = 'report/controller_ctl/$1/$2';

$route['report/(:any)/(:any)/(:any)'] = 'report/controller_ctl/$1/$2/$3';


// CETAK
$route['cetak']  = 'cetak/controller_ctl';

$route['cetak/(:any)'] = 'cetak/controller_ctl/$1';

$route['cetak/(:any)/(:any)'] = 'cetak/controller_ctl/$1/$2';

// DEFAULT PAGE
$route['default_controller'] = 'auth/controller_ctl/';


// MANIPULASI LINK

$route['404_override'] = '';


$route['translate_uri_dashes'] = TRUE;
