<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/papan-kontrol(:any)', 'Home::papanKontrolBin');
$routes->get('/daftar-urut-kepangkatan', 'Home::duk');
$routes->post('/daftar-urut-kepangkatan', 'Home::fetch_pegawai');
$routes->get('/galeri', 'Home::galeri');
$routes->get('/tentang/struktur-organisasi', 'DataPegawai::struktur');
$routes->get('/jadwal-sidang-pidum', 'Home::jadwalsidang');
$routes->post('/jadwal-sidang-pidum', 'Home::fetch_jadwalsidang_data');
$routes->get('/barang-bukti', 'Home::barangbukti');
$routes->post('/barang-bukti', 'Home::fetch_bb_data');
// Artikel Routes
$routes->get('/berita', 'Page::list_berita');
$routes->get('/berita(:any)', 'Page::artikel$1');
$routes->get('/page(:any)', 'Page::index$1');
//laporan
$routes->post('/lapor', 'Home::lapor');
//Laporan Pengaduan Masyarakat
$routes->get('/lapdu_v1', 'Home::lapdu');
$routes->post('/lapdu_v1_cek', 'Home::lapdu_v1_cek');
$routes->post('/lapdu_v1_create', 'Home::lapdu_v1_create');
$routes->get('/lapdu_v1/tiket(:any)', 'Home::printTicketHTML');


// Admin 
// $routes->group('admin',  function($routes) {
    $routes->get('/logout', 'Admin::logout', ['filter' => 'authfilter']);
    $routes->get('/cms', 'Admin::index', ['filter' => 'authfilter']);
    //post route
    $routes->get('/cms/create_post', 'Page::create_post', ['filter' => 'authfilter']);
    $routes->get('/cms/update_post', 'Page::update_post', ['filter' => 'authfilter']);
    $routes->get('/cms/list_post', 'Page::list_post', ['filter' => 'authfilter']);
    $routes->get('/cms/set-post-status(:any)', 'Page::setstatuspost$1', ['filter' => 'authfilter']);
    $routes->get('/cms/delete-post(:any)', 'Page::deletepost$1', ['filter' => 'authfilter']);
    $routes->post('/cms/save-post(:any)', 'Page::createpost$1', ['filter' => 'authfilter']);
    $routes->post('/cms/update-post(:any)', 'Page::updatepost$1', ['filter' => 'authfilter']);
    //page route
    $routes->get('/cms/list_page', 'Page::list_page', ['filter' => 'authfilter']);
    $routes->get('/cms/update_page', 'Page::update_page', ['filter' => 'authfilter']);
    $routes->post('/cms/update-page', 'Page::updatepage', ['filter' => 'authfilter']);
    $routes->get('/cms/admin-page(:any)', 'Page::adminpage$1', ['filter' => 'authfilter']);
    //galeri route
    $routes->get('/cms/gallery', 'Galeri::list_galeri', ['filter' => 'authfilter']);
    $routes->get('/cms/set-galeri-show(:any)', 'Galeri::setstatus$1', ['filter' => 'authfilter']);
    $routes->get('/cms/delete-galeri(:any)', 'Galeri::delete$1', ['filter' => 'authfilter']);
    $routes->get('/cms/add-gallery', 'Galeri::addfoto', ['filter' => 'authfilter']);
    $routes->post('/cms/save-foto(:any)', 'Galeri::add_foto$1', ['filter' => 'authfilter']);
    $routes->get('/cms/edit_gambar', 'Galeri::editfoto', ['filter' => 'authfilter']);
    $routes->post('/cms/update-gambar(:any)', 'Galeri::updategambar$1', ['filter' => 'authfilter']);
    //jadwalsidang
    $routes->get('/cms/jadwal-sidang-pidum', 'Admin::sidangpidum', ['filter' => 'authfilter']);
    $routes->post('/cms/add-sidang-pidum', 'Admin::addsidangpidum', ['filter' => 'authfilter']);
    $routes->get('/cms/delete-sidang-pidum(:any)', 'Admin::deletesidangpidum$1', ['filter' => 'authfilter']);
    //daftar barang bukti
    $routes->get('/cms/daftar-barang-bukti', 'Admin::barangbukti', ['filter' => 'authfilter']);
    $routes->post('/cms/add-barang-bukti', 'Admin::addbarangbukti', ['filter' => 'authfilter']);
    $routes->get('/cms/set-barang-bukti(:any)', 'Admin::setbarangbukti$1', ['filter' => 'authfilter']);
    $routes->get('/cms/delete-barang-bukti(:any)', 'Admin::deletebarangbukti$1', ['filter' => 'authfilter']);
    //general
    $routes->get('/cms/setting', 'Admin::setting', ['filter' => 'authfilter']);
    $routes->get('/cms/set-carousel-show(:any)', 'Admin::setcarouselshow$1', ['filter' => 'authfilter']);
    $routes->get('/cms/delete-carousel(:any)', 'Admin::deletecarousel$1', ['filter' => 'authfilter']);
    $routes->post('/cms/save-carousel(:any)', 'Admin::addcarousel$1', ['filter' => 'authfilter']);
    $routes->post('/cms/save-env(:any)', 'Admin::saveenv$1', ['filter' => 'authfilter']);
    //aduan
    $routes->get('/cms/aduan', 'Admin::aduan', ['filter' => 'authfilter']);

    //pegawai
    $routes->get('/cms/list_pegawai', 'Admin::daftar_pegawai',['filter' => 'authfilter']);
    //lapdu v1
    $routes->get('/cms/lapdu_v1', 'Admin::lapdu_v1', ['filter' => 'authfilter']);
    $routes->post('/cms/lapdu_v1', 'Admin::fetch_lapdu_data');
    $routes->get('/media/lapdu_v1(:any)', 'Admin::getPdfLapdu$1', ['filter' => 'authfilter']);
    $routes->get('/cms/lapdu_v1/(:segment)', 'Admin::detail_lapdu/$1', ['filter' => 'authfilter']);
    $routes->get('/cms/lapdu_v1/update/(:any)', 'Admin::setLapdu/$1/$2', ['filter' => 'authfilter']);
    $routes->get('/cms/lapdu_v1/delete/(:any)', 'Admin::hapusTindakan/$1', ['filter' => 'authfilter']);
    $routes->post('/cms/lapdu_v1/add', 'Admin::tambahTindakan', ['filter' => 'authfilter']);
    
$routes->get('/cms/get_csrf_token', function(){
    return csrf_hash();
});

// });
$routes->get('/login', 'Admin::login', ['filter' => 'isauthfilter']);
$routes->post('/login', 'Admin::login_action', ['filter' => 'isauthfilter']);


// Will display 404
$routes->set404Override(function()
{
    $data['error_code'] = '404';
    $data['error_name'] = 'Halaman <u>'.$_SERVER['REQUEST_URI'].'</u> tidak ditemukan';
    echo view('error_production.php',$data);
    // return redirect()->to(base_url('/page'.$_SERVER['REQUEST_URI']));
});
// $routes->add('(:any)', function() {
//     return 'Not Found ....';
// }); 

/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}