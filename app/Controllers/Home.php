<?php

namespace App\Controllers;
use App\Models\MainModel;
use App\Models\PegawaiModel;
use App\Models\PageModel;
use App\Models\FotoModel;

// secret site key recaptha = 6LcIhhsiAAAAADc8LeRwMX7KQlT6r2lHv0eaB3_s

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

    function getIpClient(){
        $ip = '';
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
        return $ip;
    }

    public function display(){
        //whether ip is from the share internet  
        $ip = $this->getIpClient();
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

    public function lapor(){
        if (!$this->validate([
			'nama' => [
				'rules' => 'required|max_length[100]|min_length[2]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
                    'min_length' => '{field} Terlalu Pendek',
				]
			],
            'email' => [
				'rules' => 'required|max_length[100]|min_length[2]|valid_email',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
                    'min_length' => '{field} Terlalu Pendek',
                    'email' => '{field} Tidak Valid',
				]
			],
            'telepon' => [
				'rules' => 'required|max_length[50]|min_length[8]|numeric',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
                    'min_length' => '{field} Terlalu Pendek',
                    'number' => '{field} Tidak Valid',
				]
			],
            'isi' => [
				'rules' => 'required|max_length[256]|min_length[5]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
                    'min_length' => '{field} Terlalu Pendek',
				]
			],
            'captca' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak Valid',
				]
			],
        ])){
            // return redirect()->to($_SERVER['HTTP_REFERER'].'#aduan')->with('error', $this->validator->listErrors());
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $myvars = 'secret=6LcIhhsiAAAAADc8LeRwMX7KQlT6r2lHv0eaB3_s&response='.$this->request->getPost('captca');
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec( $ch ));
        if(!$response->success) return redirect()->to($_SERVER['HTTP_REFERER'].'#aduan')->with('error', "Captca tidak valid");
        $data = array(
            'nama_pelapor' => $this->request->getPost('nama'),
            'tlp' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'isi' => $this->request->getPost('isi'),
            'ipv4' =>  $this->getIpClient()
        );
        $data = $this->main_model->saveLaporan($data);
        if($data) $data = 'Pesan Anda Telah Diterima, Terimakasih Atas Laporan Anda!';
        return redirect()->to($_SERVER['HTTP_REFERER'].'#aduan')->with('success', $data);
    }
}