<?php

namespace App\Controllers;
use App\Models\MainModel;
use App\Models\PegawaiModel;
use App\Models\PageModel;
use App\Models\FotoModel;
include('ExsternalApiController.php');

// secret site key recaptha = 6LcIhhsiAAAAADc8LeRwMX7KQlT6r2lHv0eaB3_s

class Home extends BaseController{
    public function __construct(){
        $this->main_model = new MainModel();
        $this->page_model = new PageModel();
        $this->pegawai = new PegawaiModel();
        $this->galeri_model = new FotoModel();
        $this->ext_api = new ExsternalApiController();
    }

    public function index(){
        $data['page_title'] = "Kejaksaan Negeri Boalemo";
        $data['recaptcha'] = true;
        $data['pejabat'] = $this->pegawai->getPejabat();
        $data['header'] = $this->main_model->getHeaderImage();
        $data['galeri'] = $this->galeri_model->getTerbaru();
        $data['hero'] = 'hero-img.png';
        $data['post_ig'] = $this->ext_api->getPostInstagram();
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
            $data['post_ig'] = $this->ext_api->getPostInstagram();
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
        $data['data'] = $this->main_model->getJadwalSidang(date('m'),true);
        $data['now'] = $this->main_model->getJadwalSidangHariIni();
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

    public function barangbukti(){
        $data['datatables'] = true;
        $data['page'] = $this->page_model->getPage('daftar-barang-bukti');
        $data['data'] = $this->main_model->getDaftarBarangBukti(true);
        $data['page_title'] = "Daftar Barang Bukti Perkara - Kejaksaan Negeri Boalemo";
        return view('public/daftar_barang_bukti', $data);
    }

    public function lapdu(){
        $data['page_title'] = "Laporan Pengaduan Masyarakat Online";
        $data['recaptcha'] = true;
        $data['kategori_lapdu'] = $this->main_model->getKategoriLapdu();
        return view('public/lapdu', $data);
    }

    public function lapdu_v1_create(){
        if (!$this->validate([
            'captca' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak Valid',
				]
			],
			'kategori' => [
				'rules' => 'required|is_not_unique[tbl_lapdu_kategori.id]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'is_not_unique' => '{field} Tidak Valid',
				]
			],
            'nama' => [
				'rules' => 'max_length[100]|permit_empty',
				'errors' => [
                    'max_length' => '{field} Terlalu Panjang atau kosongkan',
				]
			],
            'telepon' => [
				'rules' => 'max_length[15]|min_length[8]|permit_empty',
				'errors' => [
                    'max_length' => '{field} Terlalu Panjang atau kosongkan',
                    'min_length' => '{field} Terlalu Pendek atau kosongkan',
				]
			],
            'email' => [
				'rules' => 'valid_email|max_length[100]|permit_empty',
				'errors' => [
                    'valid_email' => '{field} Tidak Valid atau kosongkan',
                    'max_length' => '{field} Terlalu Panjang atau kosongkan',
				]
			],
            'isi' => [
				'rules' => 'required|max_length[256]|min_length[10]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
                    'min_length' => '{field} Terlalu Pendek',
				]
			],
            'data_dukung' => [
				'rules' => 'uploaded[data_dukung]|max_size[data_dukung, 4096]|mime_in[data_dukung,application/pdf]',
				'errors' => [
                    'uploaded' => '{field} Tidak boleh kosong',
                    'max_size' => '{field} Terlalu besar',
                    'mime_in' => '{field} Harus dalam bentuk PDF',
				]
			],
        ])){
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $captca = $this->ext_api->validate_captca($this->request->getPost('captca'));
        if(!$captca) return redirect()->back()->with('error', "Captca tidak valid refresh halaman ini");
        //generate ticket number
        $num = 1001;
        $tgl = date("Ymdhis");
        $tiket = $tgl.$num;
        $cek = $this->main_model->ticketLapduExist($tiket);
        while($cek){
            $num++;
            $tiket = $tgl.$num;
            $cek = $this->main_model->ticketLapduExist($tiket);
        }
        $upload = $this->request->getFile('data_dukung');
        if (!file_exists('media/lapdu')) {
            mkdir('media/lapdu', 0777, true);
        }
        $filename = $tiket.'.'.$upload->getClientExtension();
		$upload->move('media/lapdu/', $filename);
        $data = array(
            'kategori' => $this->request->getPost('kategori'),
            'nama_pelapor' =>  $this->request->getPost('nama'), 
            'email' => $this->request->getPost('email'), 
            'tlp' => $this->request->getPost('telepon'), 
            'uraian' => $this->request->getPost('isi'), 
            'data' => $filename, 
            'tiket' =>  $tiket,
            'is_active' => 1,
            'is_priority' => 0,
            'is_pending' => 0,
        );
        $data = $this->main_model->saveLapdu($data);
        if($data){
            return redirect()->back()->with('success', $tiket);
        }
        return redirect()->back()->with('error', "Terjadi kesalahan, slahkan ulangi beberapa saat lagi");
    }

    function printTicketHTML() {
        $nomor =  $this->request->getGet('tiket');
        if($this->main_model->ticketLapduExist($nomor)){
            // Mengatur header Content-Type ke text/html
            header('Content-Type: text/html');
            // Menghasilkan tampilan HTML tiket
            echo '
            <!DOCTYPE html>
            <html>
                <head>
                <title>Tiket Laporan Pengaduan Masyarakat Online</title>
                <style>
                    body{
                        display: none;
                    }
                    @media print {
                        body{
                            display: block;
                        }
                    }
                    /* Gaya CSS untuk kop tiket */
                    .header {
                    text-align: center;
                    margin-bottom: 20px;
                    }
                    .logo {
                    width: 100px;
                    height: 100px;
                    }
                    .organization {
                    font-size: 24px;
                    font-weight: bold;
                    margin-bottom: 5px;
                    }
                    .address {
                    font-size: 14px;
                    margin-bottom: 5px;
                    }
                    .phone {
                    font-size: 14px;
                    margin-bottom: 5px;
                    }
                    .fax {
                    font-size: 14px;
                    margin-bottom: 20px;
                    }
                    .title {
                    font-size: 28px;
                    font-weight: bold;
                    text-align: center;
                    margin-bottom: 20px;
                    }
                    .content {
                    font-size: 16px;
                    margin-bottom: 20px;
                    line-height: 1.5;
                    }
                    .ticket-number {
                    text-align : center;
                    font-size: xx-large;
                    font-weight: bold;
                    margin-bottom: 10px;
                    }
                    .date-time {
                    font-size: 16px;
                    font-style: italic;
                    margin-bottom: 10px;
                    }
                    .message {
                    margin-bottom: 10px;
                    }
                    .note {
                    margin-bottom: 10px;
                    }
                    .btn-print {
                    text-align: center;
                    margin-top: 20px;
                    }
                </style>
                <script>
                    // Fungsi untuk memunculkan popup cetak
                    window.print();
                    window.addEventListener("afterprint", function() {
                        window.close();
                    });
                </script>
                </head>
                <body>
                <div class="header">
                    <div class="organization">KEJAKSAAN NEGERI BOALEMO</div>
                </div>
                <div class="title">Tiket Laporan Pengaduan Masyarakat Online</div>
                <div class="content">
                    <div class="ticket-number">Nomor Tiket: #'.$nomor.'</div>
                    <div class="date-time">19 Mei 2023, 10:30 WITA</div>
                    <div class="message">
                    Terima kasih atas laporan pengaduan Anda. Tiket ini merupakan bukti penerimaan laporan Anda oleh Kejaksaan Negeri Boalemo. Tim kami akan segera melakukan tindak lanjut terhadap laporan yang Anda ajukan.
                    </div>
                    <div class="note">
                    Harap simpan tiket ini sebagai referensi untuk informasi lebih lanjut.
                    </div>
                </div>
                </body>
            </html>
            ';
        }else{
            echo '<script>
                    window.close();
            </script>';
        }
    }

    public function lapdu_v1_cek(){
        if (!$this->validate([
            'captca' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak Valid',
				]
			],
			'tiket' => [
				'rules' => 'required|is_not_unique[tbl_lapdu_laporan.tiket]',
				'errors' => [
					'required' => 'Nomor Tiket Tidak boleh kosong',
                    'is_not_unique' => 'Tiket Tidak Ditemukan',
				]
			],
        ])){
			session()->setFlashdata('error_tiket', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $captca = $this->ext_api->validate_captca($this->request->getPost('captca'));
        if(!$captca) return redirect()->back()->with('error_tiket', "Captca tidak valid refresh halaman ini");
        $tiket = $this->main_model->getTiket($this->request->getPost('tiket'));
        $act = $this->main_model->getTindakLanjut($tiket[0]->id_lapdu);
        $data = array(
            'no_tiket' => $this->request->getPost('tiket'),
            'uraian' => $tiket[0]->uraian,
            'status' => $tiket[0]->is_pending?"Pending":"Aktif",
            'prioritas' => $tiket[0]->is_priority?"Prioritas":"Normal",
            'riwayat' => array_merge($act, [(object)[
                "tindakan" => "Laporan dibuat",
                "oleh" => "Pelapor",
                "created_at" => $tiket[0]->created_at
            ]])
        );
        return redirect()->back()->with('success_tiket', $data);
    }
}