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

    function getPostInstagram(){
        $url = "https://graph.instagram.com/me/media?fields=media_url&access_token=";
        $url .= getenv('ACCESS_TOKEN');
        $url .= '&limit=5';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch); 
        return json_decode($result);
    }

    public function index(){
        $data['page_title'] = "Kejaksaan Negeri Boalemo";
        $data['pejabat'] = $this->pegawai->getPejabat();
        $data['header'] = $this->main_model->getHeaderImage();
        $data['galeri'] = $this->galeri_model->getTerbaru();
        $data['hero'] = 'hero-img.png';
        $data['post_ig'] = $this->getPostInstagram()->data;
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
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
        } 
        //for developmen delete if production
        $ip = '36.85.221.6';
        //
        if($ip === getenv('IP_KANTOR')){
            $data['data'] = $this->pegawai->getListPegawai();
            $data['running_text'] = $this->main_model->getVariable('running_text');
            $data['timeout'] = $this->main_model->getVariable('display_timeout');
            $data['post_ig'] = $this->getPostInstagram()->data;
            $data['slider_display'] = $this->main_model->getVariable('slider');
            $data['slider_display'] = explode(';',$data['slider_display'][0]->value);
            return view('public/display', $data);
        }else{
            echo "Hanya untuk Kantor";
        }
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