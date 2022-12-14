<?php

namespace App\Controllers;
use App\Models\MainModel;
use App\Models\PegawaiModel;
use App\Models\PageModel;
use App\Models\UsersModel;
use App\Models\JadwalSidangModel;
use App\Models\DaftarBarangBukti;

class Admin extends BaseController{
    
    public function __construct(){
        $this->main_model = new MainModel();
        $this->pegawai = new PegawaiModel();
        $this->page_model = new PageModel();
        $this->user = new UsersModel();
        $this->jadwalsidangpidum = new JadwalSidangModel();
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
                return redirect()->to(base_url('/cms'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        }
        session()->setFlashdata('error', 'Username tidak ditemukan');
        return redirect()->back();
    }

    public function daftar_pegawai(){
        $data['page_title'] = "Daftar Pegawai KN Boalemo";
        $data['page_header'] = "Kejari Boalemo";
        $data['datatables'] = true;
        $data['data'] = $this->pegawai->getListPegawai();
        return view('admin/pegawai/list', $data);
    }

    public function sidangpidum(){
        if(!in_array('pidana-umum',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        $data['datatables'] = true;
        $data['select_bootstrap'] = true;
        $data['data'] = $this->main_model->getJadwalSidang(date('m'));
        $data['jaksa'] = $this->pegawai->getJaksa();
        $data['nama_bulan'] = date('F');
        $data['page_title'] = "Jadwal Sidang Kejaksaan Negeri Boalemo";
        return view('admin/sidang', $data);
    }

    public function addsidangpidum(){
        if(!in_array('pidana-umum',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
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
            'keterangan' => $this->request->getPost('keterangan')
        );
        $data = $this->main_model->setJadwalSidang($data, $this->request->getPost('jaksa'));
        if($data) return redirect()->to(base_url('/cms/jadwal-sidang-pidum'))->with('success', "Berhasil menambahkan post");
        else return redirect()->to(base_url('/cms/jadwal-sidang-pidum'))->with('error', "Gagal menambahkan post");
    }

    public function deletesidangpidum($param){
        if(!in_array('pidana-umum',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        $data = $this->main_model->hapusJadwal($param);
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
		$upload->move('assets/img/header/', $fileName);
        $tmbl = \Config\Services::image()
              ->withFile('assets/img/header/'.$fileName)
              ->resize(150, 150, true, 'height')
              ->save('assets/img/header/thumbnail/'. $fileName);
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
        $data['daftar'] = $this->main_model->getDaftarBarangBukti();
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
}