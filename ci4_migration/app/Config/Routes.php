<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * @context7 /codeigniter/route
 * @description Custom route options for better organization
 */

// Test route for Phase 3 migration verification
$routes->get('phase3test', 'Phase3Test::index');
$routes->get('phase3test/testBaseController', 'Phase3Test::testBaseController');
$routes->get('phase3test/testRoutes', 'Phase3Test::testRoutes');

// Redirect root to login page
$routes->get('/', 'Auth::index');

// Auth routes (Login/Logout/Register)
$routes->group('login', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('do_login', 'Auth::do_login');
    $routes->get('register_berhasil', 'Auth::register_berhasil');
    $routes->post('do_register', 'Auth::do_register');
    $routes->get('prestasi', 'Auth::prestasi');
    $routes->get('uname_avaible', 'Auth::uname_avaible');
    $routes->get('do_logout', 'Auth::do_logout');
    $routes->get('admin', 'Auth::admin');
    $routes->post('do_login_admin', 'Auth::do_login_admin');
    $routes->get('test', 'Auth::test');
});

// Admin routes
$routes->group('admin', ['namespace' => 'App\Controllers', 'filter' => 'admin-auth'], static function ($routes) {
    $routes->get('/', 'Admin::beranda');
    $routes->get('beranda', 'Admin::beranda');
    $routes->get('password', 'Admin::password');
    $routes->post('change_password/(:any)', 'Admin::change_password/$1');
    $routes->get('lihat', 'Admin::lihat');
    $routes->get('lihat/(:any)', 'Admin::lihat/$1');
    $routes->get('lihat_ajax/(:any)', 'Admin::lihat_ajax/$1');
    $routes->get('uncomplete_ajax/(:any)', 'Admin::uncomplete_ajax/$1');
    $routes->get('nilai', 'Admin::nilai');
    $routes->get('nilai/(:any)', 'Admin::nilai/$1');
    $routes->get('nilai_ajax/(:any)', 'Admin::nilai_ajax/$1');
    $routes->post('edit_rapor/(:num)', 'Admin::edit_rapor/$1');
    $routes->get('lihat_rapor/(:num)', 'Admin::lihat_rapor/$1');
    $routes->get('registrant/(:num)', 'Admin::registrant/$1');
    $routes->post('do_password_registrant/(:num)', 'Admin::do_password_registrant/$1');
    $routes->post('do_edit_profil/(:num)', 'Admin::do_edit_profil/$1');
    $routes->post('do_edit_detail/(:num)', 'Admin::do_edit_detail/$1');
    $routes->post('do_edit_parent/(:num)/(:any)', 'Admin::do_edit_parent/$1/$2');
    $routes->post('do_edit_letter/(:num)', 'Admin::do_edit_letter/$1');
    $routes->post('upload_foto/(:num)', 'Admin::upload_foto/$1');
    $routes->get('hapus_registrant/(:num)', 'Admin::hapus_registrant/$1');
    $routes->get('pembayaran', 'Admin::pembayaran');
    $routes->get('pembayaran/(:num)', 'Admin::pembayaran/$1');
    $routes->get('prestasi', 'Admin::prestasi');
    $routes->get('prestasi/(:num)', 'Admin::prestasi/$1');
    $routes->get('lihat_dokumen/(:num)', 'Admin::lihat_dokumen/$1');
    $routes->post('upload_cert/(:num)', 'Admin::upload_cert/$1');
    $routes->get('hapus_sertifikat/(:num)/(:num)', 'Admin::hapus_sertifikat/$1/$2');
    $routes->get('print_sertifikat/(:num)', 'Admin::print_sertifikat/$1');
    $routes->get('verifikasi/(:num)/(:any)', 'Admin::verifikasi/$1/$2');
    $routes->get('export_data/(:any)/(:any)', 'Admin::export_data/$1/$2');
    $routes->get('export_rapor/(:any)/(:any)', 'Admin::export_rapor/$1/$2');
    $routes->get('export_data_uncomplete', 'Admin::export_data_uncomplete');
    $routes->get('export_data_unpaid', 'Admin::export_data_unpaid');
    $routes->get('print_kartu_incomplete/(:any)', 'Admin::print_kartu_incomplete/$1');
    $routes->get('tes_surat', 'Admin::tes_surat');
});

// Registrant routes
$routes->group('(:num)', ['namespace' => 'App\Controllers', 'filter' => 'registrant-auth'], static function ($routes) {
    $routes->get('beranda', 'Registrant::dashboard/$1');
    $routes->get('password', 'Registrant::password/$1');
    $routes->post('change_password', 'Registrant::change_password/$1');
    $routes->get('generate_kodeunik/(:any)', 'Registrant::generate_kodeunik/$1/$2');
    $routes->get('getFoto/(:any)', 'Registrant::getFoto/$1/$2');
    $routes->post('ajax_edit_profil', 'Registrant::ajax_edit_profil/$1');
    $routes->get('formulir', 'Registrant::formulir/$1');
    $routes->get('wali', 'Registrant::guardian/$1');
    $routes->post('do_edit_guardian', 'Registrant::do_edit_guardian/$1');
    $routes->post('ajax_edit_all', 'Registrant::ajax_edit_all/$1');
    $routes->get('rapor', 'Registrant::isi_rapor/$1');
    $routes->post('edit_rapor', 'Registrant::edit_rapor/$1');
    $routes->get('finalisasi/(:any)', 'Registrant::finalisasi/$1/$2');
    $routes->post('upload_foto', 'Registrant::upload_foto/$1');
    $routes->post('upload_receipt', 'Registrant::upload_receipt/$1');
    $routes->get('getReceipt/(:any)', 'Registrant::getReceipt/$1/$2');
    $routes->get('rekap', 'Registrant::rekap/$1');
    $routes->get('print_data_pendaftaran/(:any)', 'Registrant::print_data_pendaftaran/$1/$2');
    $routes->get('surat', 'Registrant::surat/$1');
    $routes->get('sertifikat', 'Registrant::sertifikat/$1');
    $routes->post('isi_pernyataan', 'Registrant::isi_pernyataan/$1');
    $routes->post('upload_cert', 'Registrant::upload_cert/$1');
    $routes->get('img_sertifikat/(:any)', 'Registrant::img_sertifikat/$1/$2');
    $routes->get('hapus_sertifikat/(:num)', 'Registrant::hapus_sertifikat/$1');
    $routes->get('print_kartu', 'Registrant::print_kartu');
});

// Public routes
$routes->group('registrant', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('lihat', 'Registrant::lihat');
    $routes->get('lihat/(:any)', 'Registrant::lihat/$1');
    $routes->get('lihat_ajax/(:any)', 'Registrant::lihat_ajax/$1/$2');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
