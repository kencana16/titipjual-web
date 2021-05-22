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
$route['default_controller'] = 'login';
$route['404_override'] = 'errors/error404';
$route['translate_uri_dashes'] = FALSE;

$route['barang'] = 'barang/daftar_barang';
$route['barang/edit_barang'] = 'barang/daftar_barang';
$route['barang/hapus_barang'] = 'barang/daftar_barang';

$route['penjual'] = 'penjual/daftar_penjual';
$route['penjual/edit_penjual'] = 'penjual/daftar_penjual';
$route['penjual/hapus_penjual'] = 'penjual/daftar_penjual';

$route['pengeluaran/edit_pengeluaran'] = 'pengeluaran/daftar_pengeluaran';
$route['pengeluaran/detail_pengeluaran'] = 'pengeluaran/daftar_pengeluaran';
$route['pengeluaran/hapus_pengeluaran'] = 'pengeluaran/daftar_pengeluaran';

$route['penjualan/edit_penjualan'] = 'penjualan/daftar_penjualan';
$route['penjualan/hapus_penjualan'] = 'penjualan/daftar_penjualan';

$route['pesanan/edit_pesanan'] = 'pesanan/daftar_pesanan';
$route['pesanan/hapus_pesanan'] = 'pesanan/daftar_pesanan';

$route['penjualanku/edit_penjualan'] = 'penjualanku/daftar_penjualan';
$route['penjualanku/hapus_penjualan'] = 'penjualanku/daftar_penjualan';

$route['pesananku/edit_pesanan'] = 'pesananku/daftar_pesanan';
$route['pesananku/hapus_pesanan'] = 'pesananku/daftar_pesanan';


