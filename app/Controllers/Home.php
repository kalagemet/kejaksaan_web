<?php

namespace App\Controllers;
use App\Models\MainModel;
use App\Models\PegawaiModel;
use App\Models\PageModel;
use App\Models\FotoModel;

class Home extends BaseController{
    public function __construct(){
        $this->main_model = new MainModel();
        $this->page_model = new PageModel();
        $this->pegawai = new PegawaiModel();
        $this->galeri_model = new FotoModel();
    }

    public function index(){
        $data['page_title'] = "Kejaksaan Negeri Boalemo";
        $data['pejabat'] = $this->pegawai->getPejabat();
        $data['header'] = $this->main_model->getHeaderImage();
        $data['galeri'] = $this->galeri_model->getTerbaru();
        $data['hero'] = 'hero-img.png';
        $data['berita_terbaru'] = $this->page_model->getListBerita()->limit(4)->get()->getResult();
        return view('public/index', $data);
    }

    public function duk(){
        $data['page_title'] = "Daftar Urut Kepangkatan Kejaksaan Negeri Boalemo";
        $data['datatables'] = true;
        $data['data'] = $this->pegawai->getListPegawaiPublik();
        return view('public/daftar_pegawai', $data);
    }

    public function display(){
        // if ($_POST['pass']!=='KejariBoalemo123'){
        //     return redirect()->back();
        // }
        $data['data'] = $this->pegawai->getListPegawai();
        $data['running_text'] = $this->main_model->getRunningText();
        $data['timeout'] = $this->main_model->getDisplayTimeout();
        $data['slider_display'] = $this->main_model->getDisplayGallery();
        $data['slider_display'] = explode(';',$data['slider_display'][0]->slider_display);
        return view('public/display', $data);
    }

    public function galeri(){
        $request = service('request');
        $pager = service('pager');
        $page = 1;
        $perPage = 10;
        $date = null;
        $string = null;
        $tag = null;
        if($request->getGet('page_galeri')>0) $page = (int) $request->getGet('page_galeri');
        if($request->getGet('filter_')){
            $date = strtotime("01-".$request->getGet('filter_'));
            $data['filter_title'] = "Galeri bulan ".date('F Y',$date);
            $data['filter_'] = $request->getGet('filter_');
        }
        if($request->getGet('tag')){
            $tag = $request->getGet('tag');
            $data['filter_title'] = "Berita dengan tagar #".$tag;
        }
        if($request->getGet('filter_string')){
            $string = $request->getGet('filter_string');
            $data['filter_title'] = "Hasil pencarian &Prime;".$string." &Prime;";
            if($date){
                $data['filter_title'] = $data['filter_title']." pada bulan ".date('F Y',$date);
            }
            $data['filter_string'] = $request->getGet('filter_string');
        }
        $data['data'] = $this->galeri_model->getGambar($date , $string, $tag);
        $count = $this->galeri_model->getGambar($date)->countAll();
        $data['data'] = $data['data']->paginate($perPage, 'galeri', $page);
        $pager->makeLinks($page,$perPage,$count, 'bootstrap_pagination',0,'galeri');
        $data['pager'] = $pager;
        $data['page_title'] = "Galeri Kejaksaan Negeri Boalemo";
        return view('public/galeri', $data);
    }

    public function jadwalsidang(){
        $data['datatables'] = true;
        $data['data'] = $this->main_model->getJadwalSidang(date('m'));
        $data['nama_bulan'] = date('F');
        $data['page_title'] = "Jadwal Sidang Kejaksaan Negeri Boalemo";
        return view('public/jadwal_sidang', $data);
    }
}