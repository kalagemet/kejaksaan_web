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
$routes->get('/display-duk', 'Home::display');
$routes->get('/daftar-urut-kepangkatan', 'Home::duk');
$routes->get('/galeri', 'Home::galeri');
$routes->get('/tentang/struktur-organisasi', 'DataPegawai::struktur');
$routes->get('/jadwal-sidang-pidum', 'Home::jadwalsidang');
$routes->get('/barang-bukti', 'Home::barangbukti');
// Artikel Routes
$routes->get('/berita', 'Page::list_berita');
$routes->get('/berita(:any)', 'Page::artikel$1');
$routes->get('/page(:any)', 'Page::index$1');
//laporan
$routes->post('/lapor', 'Home::lapor');


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
    $routes->get('/cms/daftar-barang-bukti', 'Page::barangbukti', ['filter' => 'authfilter']);
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
    $routes->get('/api/get_list_pegawai','DataPegawai::getListPegawai',['filter' => 'authfilter']);
// });
$routes->get('/login', 'Admin::login', ['filter' => 'isauthfilter']);
$routes->post('/login', 'Admin::login_action', ['filter' => 'isauthfilter']);


// Will display 404
$routes->set404Override(function()
{
    $data['error_code'] = '404';
    $data['error_name'] = 'Halaman tidak ditemukan';
    echo view('error_production.php',$data);
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