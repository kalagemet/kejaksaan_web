<?php

namespace App\Controllers;
use App\Models\MainModel;
use App\Models\LapduModel;
use App\Models\TindakanModel;
use App\Models\PegawaiModel;
use App\Models\PageModel;
use App\Models\UsersModel;
use App\Models\JadwalSidangModel;
use App\Models\DaftarBarangBukti;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class Admin extends BaseController{
    
    public function __construct(){
        $this->main_model = new MainModel();
        $this->tindakan_model = new TindakanModel();
        $this->lapdu_model = new LapduModel();
        $this->pegawai = new PegawaiModel();
        $this->page_model = new PageModel();
        $this->user = new UsersModel();
        $this->jadwalsidangmodel = new JadwalSidangModel();
        $this->daftarbb = new DaftarBarangBukti();
    }

    public function index(){
        $data['page_title'] = "Administrator Kejaksaan Negeri Boalemo";
        return view('admin/index', $data);
    }

    public function login(){
        $data['page_title'] = "Login Administrator Kejaksaan Negeri Boalemo";
        return view('admin/login', $data);
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('/login'))->with('message','Logout berhasil');
    }

    public function login_action(){
        // return password_hash('522971337', PASSWORD_DEFAULT, ['cost' => 10]);
        $users = new UsersModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $dataUser = $users->getUser()->where(
            'username', $username
        )->first();
        if ($dataUser) {
            // user found
            if (password_verify($password, $dataUser['password'])) {
                session()->set([
                    'id_user' => $dataUser['id_user'],
                    'username' => $dataUser['username'],
                    'name' => $dataUser['full_name'],
                    'islogin' => TRUE,
                    'permission' => explode(';',$dataUser['permission'])
                ]);
                if($this->request->getVar('url') != null) return redirect()->to(base_url(urldecode($this->request->getVar('url'))));
                return redirect()->to(base_url('/cms'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        }
        session()->setFlashdata('error', 'Username tidak ditemukan');
        return redirect()->back();
    }

    public function sidangpidum(){
        $bidang = 1;
        if(!in_array('pidana-umum',session()->permission)){
            if(!in_array('pidana-khusus',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
            $bidang = 0;
        }
        $data['datatables'] = true;
        $data['select_bootstrap'] = true;
        if($bidang) $data['bidang'] = 'Pidum';
        else $data['bidang'] = 'Pidsus';
        $data['jaksa'] = $this->pegawai->getJaksa();
        $data['page_title'] = "Jadwal Sidang Kejaksaan Negeri Boalemo";
        return view('admin/sidang', $data);
    }

    public function addsidangpidum(){
        $bidang = 1;
        if(!in_array('pidana-umum',session()->permission)){
            if(!in_array('pidana-khusus',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan"); 
            $bidang = 0;
        }
        if (!$this->validate([
			'terdakwa' => [
				'rules' => 'required|max_length[100]|min_length[2]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
                    'min_length' => '{field} Terlalu Pendek',
				]
			],
            'tanggal' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'valid_date' => '{field} tidak valid'
				]
			],
            'agenda' => [
				'rules' => 'required|min_length[5]|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
					'min_length' => '{field} Terlalu pendek'
				]
			],
            'pasal' => [
				'rules' => 'required|min_length[3]|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
					'min_length' => '{field} Terlalu pendek'
				]
			],
            'jaksa' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
            'lokasi' => [
				'rules' => 'required|max_length[100]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
				]
			],
            'keterangan' => [
				'rules' => 'required|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
				]
			],
		])){
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $data = array(
            'id_user' => session()->id_user,
            'tanggal' => $this->request->getPost('tanggal'),
            'terdakwa' => ucfirst($this->request->getPost('terdakwa')),
            'pasal' => $this->request->getPost('pasal'),
            'agenda' => $this->request->getPost('agenda'),
            'lokasi_sidang' => $this->request->getPost('lokasi'),
            'is_pidum' => $bidang,
            'keterangan' => $this->request->getPost('keterangan')
        );
        $data = $this->jadwalsidangmodel->setJadwalSidang($data, $this->request->getPost('jaksa'));
        if($data) return redirect()->to(base_url('/cms/jadwal-sidang-pidum'))->with('success', "Berhasil menambahkan post");
        else return redirect()->to(base_url('/cms/jadwal-sidang-pidum'))->with('error', "Gagal menambahkan post");
    }

    public function deletesidangpidum($param){
        if(!in_array('pidana-umum',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        $data = $this->jadwalsidangmodel->hapusJadwal($param);
        if($data){
            $msg = "Berhasil menghapus data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function setting(){
        if(!in_array('admin',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        $data['page_title'] = "Administrator Kejaksaan Negeri Boalemo";
        $data['header'] = $this->main_model->getHeaderImageAll();
        $data['env'] = $this->main_model->getEnvironment();
        return view('admin/setting', $data);
    }

    public function setcarouselshow($id){
        if(!in_array('admin',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        $data = $this->main_model->setStatusCarousel($id);
        if($data){
            $msg = "Berhasil mengupdate data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function deletecarousel($id){
        if(!in_array('admin',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        $data = $this->main_model->deleteCarousel($id);
        if($data){
            $msg = "Berhasil menghapus data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function addcarousel($param){
        if(!in_array('admin',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        $status = '0';
        if($param==="publish") $status = 1;
        //save image
        if (!$this->validate([
			'image' => [
				'rules' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
			]
		])){
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $upload = $this->request->getFile('image');
		$fileName = date("Y-m-d.h.i.s").'_carousel.'.$upload->getClientExtension();
		$upload->move('media/header/', $fileName);
        $tmbl = \Config\Services::image()
              ->withFile('media/header/'.$fileName)
              ->resize(150, 150, true, 'height')
              ->save('media/header/thumbnail/'. $fileName);
        $data = array(
            'path' =>  $fileName,
            'is_show' =>  $status,
        );
        $data = $this->main_model->saveCarousel($data);
        return redirect()->to(base_url('/cms/setting'))->with('success', "Berhasil menambahkan post");
    }

    public function saveenv($env){
        if(!in_array('admin',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        if (!$this->validate([
			$env => [
				'rules' => 'required|min_length[1]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'min_length' => '{field} Terlalu Pendek',
				]
			]
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $data = $this->main_model->saveEnv($env, $this->request->getPost($env));
        if($data){
            $msg = "Berhasil mengupdate data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function aduan(){
        $data['page_title'] = "Daftar Laporan Pada Website KN Boalemo";
        return view('admin/aduan', $data);
    }

    public function barangbukti(){
        $data['datatables'] = true;
        $data['select_bootstrap'] = true;
        $data['page_title'] = "Daftar Barang Bukti Kejaksaan Negeri Boalemo";
        $request = service('request');
        if(in_array('pengelola-barang-bukti',session()->permission) or in_array($request->getGet('key'),session()->permission)){
            $data['is_superadmin'] = ($request->getGet('key')==null);
            $data['data'] = $this->page_model->geteditpage($this->page_model->getpostid('daftar-barang-bukti')[0]->id_post);
            $data['summernote'] = true;
            return view('admin/barang-bukti', $data);
        }else{
            return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        }
    }

    public function addbarangbukti(){
        if(!in_array('pengelola-barang-bukti',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        if (!$this->validate([
			'terdakwa' => [
				'rules' => 'required|max_length[100]|min_length[2]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
                    'min_length' => '{field} Terlalu Pendek',
				]
			],
            'tgl_putusan' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'valid_date' => '{field} tidak valid'
				]
			],
            'register_barang' => [
				'rules' => 'required|min_length[5]|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
					'min_length' => '{field} Terlalu pendek'
				]
			],
            'register_perkara' => [
				'rules' => 'required|min_length[3]|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
					'min_length' => '{field} Terlalu pendek'
				]
			],
            'jenis' => [
				'rules' => 'required|min_length[3]|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
					'min_length' => '{field} Terlalu pendek'
				]
			],
            'no_putusan' => [
				'rules' => 'required|min_length[3]|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
					'min_length' => '{field} Terlalu pendek'
				]
			],
            'keterangan' => [
				'rules' => 'required|max_length[200]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang',
				]
			],
		])){
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $data = array(
            'register_perkara' => $this->request->getPost('register_perkara'),
            'register_barang' => $this->request->getPost('register_barang'),
            'jenis' => $this->request->getPost('jenis'),
            'no_putusan' => $this->request->getPost('no_putusan'),
            'amar_putusan' => $this->request->getPost('amar_putusan'),
            'tgl_putusan' => $this->request->getPost('tgl_putusan'),
            'is_release' => 1,
            'id_user' => session()->id_user,
            'terdakwa' => ucfirst($this->request->getPost('terdakwa')),
            'keterangan' => $this->request->getPost('keterangan')
        );
        $data = $this->daftarbb->addbarang($data);
        if($data) return redirect()->to(base_url('/cms/daftar-barang-bukti'))->with('success', "Berhasil menambahkan post");
        else return redirect()->to(base_url('/cms/daftar-barang-bukti'))->with('error', "Gagal menambahkan post");
    }

    public function setbarangbukti($id_post){
        if(!in_array('pengelola-barang-bukti',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->daftarbb->setStatus($id_post);
        if($data){
            $msg = "Berhasil mengupdate data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function deletebarangbukti($id_post){
        if(!in_array('pengelola-barang-bukti',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->daftarbb->hapus($id_post);
        if($data){
            $msg = "Berhasil menghapus data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function lapdu_v1(){
        $data['datatables'] = true;
        $data['page_title'] = "Laporan Pengaduan Masyarakat Kejaksaan Negeri Boalemo";
        $request = service('request');
        if(in_array('intelijen',session()->permission)){
            $data['data'] = $this->lapdu_model->getLaporan();
            // $data['csrfValue'] = csrf_hash();
            return view('admin/lapdu', $data);
        }else{
            return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        }
    }

    public function fetch_lapdu_data(){
        $request = service('request');
        $lapduModel = $this->lapdu_model;
        $columns = array(
            0 => 'tbl_lapdu_laporan.created_at',
            1 => 'tbl_lapdu_kategori.kategori',
            2 => 'IF(nama_pelapor="", "<i>Tidak Dicantumkan</i>", nama_pelapor) as nama_pelapor',
            3 => 'is_active',
            4 => 'is_pending',
            5 => 'is_priority',
            6 => 'id_lapdu',
            7 => 'tiket',
            8 => 'COALESCE((SELECT CONCAT(DATE(created_at), " - ", tbl_lapdu_tindakan.tindakan)
             FROM tbl_lapdu_tindakan 
             WHERE tbl_lapdu_tindakan.id_laporan = tbl_lapdu_laporan.id_lapdu 
             AND tbl_lapdu_tindakan.deleted_at is null
             ORDER BY tbl_lapdu_tindakan.created_at DESC
             limit 1
             ), "<span style=color:red;>Belum ditindak lanjuti</span>") as tindakan'
        );
        $totalData = $lapduModel->getLaporan()->countAllResults();
        $limit = $request->getPost('length');
        $start = $request->getPost('start');
        $order = $columns[$request->getPost('order')[0]['column']];
        $search = $request->getPost('search')['value'];
        $dir = $request->getPost('order')[0]['dir'];
        $lapduData = $lapduModel->getLaporan($columns,$order,$dir,$limit,$start,$search)->get()->getResult();
    
        $totalFiltered = $lapduModel->countAllResults();
        $data = array();
        if (!empty($lapduData)) {
            foreach ($lapduData as $row) {
                $data[] = array(
                    "id_lapdu" => $row->id_lapdu,
                    "created_at" => $row->created_at,
                    "kategori" => $row->kategori,
                    "nama_pelapor" => $row->nama_pelapor,
                    "tiket" => $row->tiket,
                    "tindakan" => $row->tindakan,
                    "status" => ($row->is_active?"Aktif":"<span style=color:green;>Selesai</span>"),
                    "jenis" => ($row->is_priority?"<span style=color:red;>Prioritas</span>":"Normal")." - ".($row->is_pending?"<span style=color:orange;>Ditunda</span>":"Proses")
                );
            }
        }
        $json_data = array(
            "draw" => intval($request->getPost('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return $this->response->setJSON($json_data);
    }

    public function detail_lapdu($param){
        $request = service('request');
        if(in_array('intelijen',session()->permission)){
            $data['datatables'] = true;
            $data['page_title'] = "Laporan Pengaduan ";
            $detail = $this->lapdu_model->getLaporan([
                'id_lapdu',
                'tiket',
                'tbl_lapdu_laporan.created_at as tanggal',
                'tbl_lapdu_kategori.kategori as kategori',
                'IF(nama_pelapor="", "<i>Tidak Dicantumkan</i>", nama_pelapor) as nama_pelapor',
                'IF(tlp="", "<i>nomor tidak ada</i>", tlp) as tlp',
                'IF(email="", "<i>email tidak ada</i>", email) as email',
                'IF(nik="", "<i>NIK tidak ada</i>", nik) as nik',
                'uraian',
                'is_active',
                'is_pending',
                'is_priority',
                "IF(is_active=1, '<span class=\"badge badge-primary\">Aktif</span>','<span class=\"badge badge-success\">Selesai</span>') as status",
                "IF(is_pending,'<span class=\"badge badge-success\">Ditangguhkan</span>','<span class=\"badge badge-warning\">Proses</span>') as pending",
                "IF(is_priority,'<span class=\"badge badge-danger\">Prioritas</span>','<span class=\"badge badge-secondary\">Normal</span>') as prioritas"
            ])->where('id_lapdu',$param);
            $tmp = $detail;
            $tmp = $tmp->countAllResults(false);
            $data['data'] = $detail->get()->getRow();
            if($tmp<1){
                session()->setFlashdata('error', 'ID Laporan tidak ditemukan');
                return redirect()->to('cms/lapdu_v1/');
            } 
            $data['tindakan'] = array_merge($this->main_model->getTindakLanjut($param), [(object)[
                "tindakan" => "Laporan dibuat",
                "oleh" => "Pelapor",
                "created_at" => $data['data']->tanggal
            ]]);
            return view('admin/detail-lapdu', $data);
        }else{
            return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        }
    }

    public function getPdfLapdu($param = "404"){
        $lapduData = $this->lapdu_model->getLaporan(['tiket'])->where('id_lapdu',$param)->limit(1);
        $tiket = "404";
        if($lapduData->countAllResults()>0) $tiket = $lapduData->get()->getResult()[0]->tiket;
        $filepath = FCPATH."media/lapdu/".$tiket.".pdf";
        if (!file_exists($filepath) || !is_readable($filepath) ) {
            $data['error_code'] = '403';
            $data['error_name'] = 'Anda tidak diizinkan mengakses halaman ini';
            return view('error_production.php',$data);
        }
        http_response_code(200);
        header("Content-Type: application/pdf");
        readfile($filepath);
        exit;
    }

    public function setLapdu($param = null, $value = null){
        $request = service('request');
        if(!in_array('intelijen',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        if(!in_array($param, ['is_active','is_pending','is_priority'])) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Parameter salah");
        $id = $this->lapdu_model->getLaporan(['id_lapdu'])->where('id_lapdu',$value)->countAllResults();
        if($id<1) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Parameter salah");
        $data = $this->lapdu_model->setStatus($param, $value);
        if($data){
            $msg = "Berhasil mengupdate data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function hapusTindakan($param = null){
        $request = service('request');
        if(!in_array('intelijen',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $id = $this->lapdu_model->getLaporan(['id_lapdu'])->where('id_lapdu',$param)->countAllResults();
        if($id<1) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Parameter salah");
        $data = $this->tindakan_model->hapusTindakan($param);
        if($data){
            $msg = "Berhasil menghapus tindakan";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function tambahTindakan(){
        $request = service('request');
        if(!in_array('intelijen',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        if (!$this->validate([
            'id_lapdu' => [
				'rules' => 'required|is_not_unique[tbl_lapdu_laporan.id_lapdu]:',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'is_not_unique' => '{field} tidak ditemukan',
				]
            ],
            'tindakan' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong',
                    'min_length' => '{field} Terlalu Pendek',
                ]
            ],
			'oleh' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'min_length' => '{field} Terlalu Pendek',
				]
			]
        ])){
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $data = array(
            'id_laporan' => $this->request->getPost('id_lapdu'),
            'tindakan' => $this->request->getPost('tindakan'),
            'oleh' => $this->request->getPost('oleh')
        );
        $data = $this->tindakan_model->tambahTindakan($data);
        if($data) return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', "Berhasil menambahkan tindakan");
        else return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Gagal menambahkan tindakan");
    }
}