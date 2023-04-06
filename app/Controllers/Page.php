<?php

namespace App\Controllers;
use App\Models\PageModel;
include('ExsternalApiController.php');

class Page extends BaseController{    
    public function __construct(){
        $this->page_model = new PageModel();
        $this->ig_handler = new ExsternalApiController();
    }

    public function index($post_name){
        $data['data'] = $this->page_model->getPage($post_name);
        if(count($data['data'])<1) $data = $this->pageNotFound($data);
        else{
            $data['page_title'] = $data['data'][0]->post_title;
        }
        $data['post_ig'] = $this->ig_handler->getPostInstagram();
        $data['count_month'] = $this->page_model->getCountBerita();
        $data['count_year'] = $this->page_model->getYearCountBerita();
        $data['berita_terbaru'] = $this->page_model->getListBerita()->limit(5)->get()->getResult();
        return view('public/berita/page', $data);
    }

    function pageNotFound($arr){
        $data = $arr;
        $data['not_found'] = true;
        $data['page_title'] = "Halaman tidak ditemukan | KN Boalemo";
        $data['error_code'] = '404';
        $data['error_name'] = 'Halaman tidak ditemukan';
        return $data;
    }

    public function artikel($post_name = null){
        $data['data'] = $this->page_model->getBerita($post_name);
        if(count($data['data'])<1) $data = $this->pageNotFound($data);
        else{
            $data['page_title'] = $data['data'][0]->post_title;
            $data['thumbnail'] = $data['data'][0]->thumbnail;
            $data['tags'] = $this->page_model->getTagsBerita($post_name)[0]->tags;
        }
        $data['count_month'] = $this->page_model->getCountBerita();
        $data['post_ig'] = $this->ig_handler->getPostInstagram();
        $data['count_year'] = $this->page_model->getYearCountBerita();
        $data['berita_terbaru'] = $this->page_model->getListBerita()->limit(5)->get()->getResult();
        return view('public/berita/artikel', $data);
    }

    public function list_berita(){
        $request = service('request');
        $pager = service('pager');
        $page = 1;
        $perPage = 10;
        $date = null;
        $string = null;
        $tag = null;
        if($request->getGet('page_berita')>0) $page = (int) $request->getGet('page_berita');
        if($request->getGet('filter_')){
            $date = strtotime("01-".$request->getGet('filter_'));
            $data['filter_title'] = "Berita pada bulan ".date('F Y',$date);
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
        $data['data'] = $this->page_model->getListBerita($date, $string, $tag);
        $count = $this->page_model->getListBerita($date, $string, $tag)->countAllResults();
        $data['data'] = $data['data']->paginate($perPage, 'berita', $page);
        $pager->makeLinks($page,$perPage,$count, 'bootstrap_pagination',0,'berita');
        $data['pager'] = $pager;
        $data['page_title'] = "Berita di Kejaksaan Negeri Boalemo";
        return view('public/berita/berita', $data);
    }

    public function create_post(){
        if(!in_array('post',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        $data['page_title'] = "Tambah Postingan";
        // $data['page_header'] = "Tambah Postingan";
        $data['summernote'] = true;
        return view('admin/post/create', $data);
    }

    public function update_post(){
        if(!in_array('post',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        $request = service('request');
        $data['data'] = $this->page_model->geteditpost($request->getGet('id'));
        $data['page_title'] = "Edit Postingan - ".$request->getGet('post');
        $data['summernote'] = true;
        return view('admin/post/edit', $data);
    }

    public function list_post(){
        if(in_array('post',session()->permission)){
            $request = service('request');
            $pager = service('pager');
            $page = 1;
            $perPage = 10;
            $date = null;
            $string = null;
            $tag = null;
            if($request->getGet('page_berita')>0) $page = (int) $request->getGet('page_berita');
            if($request->getGet('filter_')){
                $date = strtotime("01-".$request->getGet('filter_'));
                $data['filter_title'] = "Filter ".date('F Y',$date);
                $data['filter_'] = $request->getGet('filter_');
            }
            if($request->getGet('tag')){
                $tag = $request->getGet('tag');
                $data['filter_title'] = "Filter #".$tag;
            }
            if($request->getGet('filter_string')){
                $string = $request->getGet('filter_string');
                $data['filter_title'] = "Filter &Prime;".$string." &Prime;";
                if($date){
                    $data['filter_title'] = $data['filter_title']." pada bulan ".date('F Y',$date);
                }
                $data['filter_string'] = $request->getGet('filter_string');
            } 
            $data['data'] = $this->page_model->getListBeritaAll($date, $string, $tag);
            $count = $this->page_model->getListBeritaAll($date, $string, $tag)->countAllResults();
            $data['data'] = $data['data']->paginate($perPage, 'berita', $page);
            $pager->makeLinks($page,$perPage,$count, 'bootstrap_pagination',0,'berita');
            $data['pager'] = $pager;
            $data['page_title'] = "Daftar Postingan";
            return view('admin/post/list', $data);
        }else{
            return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        }
    }

    public function setstatuspost($id_post){
        if(!in_array('post',session()->permission) or !in_array('page',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->page_model->setStatusPage($id_post);
        if($data){
            $msg = "Berhasil mengupdate data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function deletepost($id_post){
        if(!in_array('post',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->page_model->deletePage($id_post);
        if($data){
            $msg = "Berhasil menghapus data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    function valid_date($date){    
        $pattern = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
        if(preg_match($pattern, $date) ){
            return true;
        } 
        else {
            $this->form_validation->set_message('valid_date', 'The %s is not valid it should match this dd/md/yyyy format');
            return false;
        }
    }

    public function createpost($param){
        if(!in_array('post',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $status = 'draf';
        if($param==="publish") $status = $param;
        //save image
        if (!$this->validate([
			'judul' => [
				'rules' => 'required|max_length[100]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang'
				]
			],
            'tanggal' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'valid_date' => '{field} tidak valid'
				]
			],
            'content' => [
				'rules' => 'required|min_length[10]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
					'min_length' => '{field} Terlalu pendek'
				]
			],
			'header' => [
				'rules' => 'uploaded[header]|mime_in[header,image/jpg,image/jpeg,image/gif,image/png]|max_size[header,2048]',
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
        $upload = $this->request->getFile('header');
		$fileName = date("Y-m-d.h.i.s").'_post.'.$upload->getClientExtension();
		$upload->move('assets/img/upload/', $fileName);
        $tmbl = \Config\Services::image()
              ->withFile('assets/img/upload/'.$fileName)
              ->resize(150, 150, true, 'height')
              ->save('assets/img/upload/thumbnail/'. $fileName);
        $data = array(
            'post_author' => session()->id_user,
            'post_date' =>  $this->request->getPost('tanggal'), 
            'post_content' => $this->request->getPost('content'), 
            'post_header' =>  base_url("assets/img/upload/$fileName"), 
            'post_title' => $this->request->getPost('judul'), 
            'tags' => $this->request->getPost('tags'), 
            'post_status' =>  $status,
            'post_name' => str_replace(' ', '-', strtolower($this->request->getPost('judul'))),
            'post_type' => 'post', 
            'thumbnail' =>  base_url("assets/img/upload/thumbnail/$fileName")

        );
        $data = $this->page_model->savepost($data);
        return redirect()->to(base_url('/cms/list_post'))->with('success', "Berhasil menambahkan post");
    }

    public function updatepost($param){
        if(!in_array('post',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $status = 'draf';
        if($param==="publish") $status = $param;
        //save image
        if (!$this->validate([
            'id_post' => [
				'rules' => 'required|is_not_unique[tbl_page.id_post]',
				'errors' => [
					'required' => '{field} Eror silahkan reload halaman ini'
				]
			],
			'judul' => [
				'rules' => 'required|max_length[256]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'max_length' => '{field} Terlalu Panjang'
				]
			],
            'tanggal' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
                    'valid_date' => '{field} tidak valid'
				]
			],
            'content' => [
				'rules' => 'required|min_length[10]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
					'min_length' => '{field} Terlalu pendek'
				]
			],
			'header' => [
				'rules' => 'mime_in[header,image/jpg,image/jpeg,image/gif,image/png]|max_size[header,2048]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
			]
		])){
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $upload = $this->request->getFile('header');
        $data = array(
            'post_author' => session()->id_user,
            'post_date' =>  $this->request->getPost('tanggal'), 
            'post_content' => $this->request->getPost('content'), 
            'post_title' => $this->request->getPost('judul'), 
            'tags' => $this->request->getPost('tags'), 
            'post_status' =>  $status,
            'post_name' => str_replace(' ', '-', strtolower($this->request->getPost('judul'))),
            'post_type' => 'post', 
        );
        if($upload->isValid()){
            $old = explode('/',$this->request->getPost('old_photo'));
            $old = $old[count($old)-1];
            if(is_file('assets/img/upload/'.$old)) unlink('assets/img/upload/'.$old);
            if(is_file('assets/img/upload/thumbnail/'.$old)) unlink('assets/img/upload/thumbnail/'.$old);
            $fileName = date("Y-m-d.h.i.s").'_post.'.$upload->getClientExtension();
            $upload->move('assets/img/upload/', $fileName);
            $tmbl = \Config\Services::image()
              ->withFile('assets/img/upload/'.$fileName)
              ->resize(150, 150, true, 'height')
              ->save('assets/img/upload/thumbnail/'. $fileName);
            $data['post_header'] =  base_url("assets/img/upload/$fileName"); 
            $data['thumbnail'] =  base_url("assets/img/upload/thumbnail/$fileName"); 
        }
        $data = $this->page_model->updatepost($data, $this->request->getPost('id_post'));
        return redirect()->to(base_url('/cms/list_post?filter_string='.$this->request->getPost('judul')))->with('success', "Berhasil Memperbarui post");
    }

    public function list_page(){
        if(in_array('page',session()->permission)){
            $request = service('request');
            $pager = service('pager');
            $page = 1;
            $perPage = 10;
            $date = null;
            $string = null;
            if($request->getGet('page_halaman')>0) $page = (int) $request->getGet('page_halaman');
            if($request->getGet('filter_')){
                $date = strtotime("01-".$request->getGet('filter_'));
                $data['filter_title'] = "Filter ".date('F Y',$date);
                $data['filter_'] = $request->getGet('filter_');
            }
            if($request->getGet('filter_string')){
                $string = $request->getGet('filter_string');
                $data['filter_title'] = "Filter &Prime;".$string." &Prime;";
                if($date){
                    $data['filter_title'] = $data['filter_title']." pada bulan ".date('F Y',$date);
                }
                $data['filter_string'] = $request->getGet('filter_string');
            } 
            $data['data'] = $this->page_model->getListPage($date, $string);
            $count = $this->page_model->getListPage($date, $string)->countAllResults();
            $data['data'] = $data['data']->paginate($perPage, 'halaman', $page);
            $pager->makeLinks($page,$perPage,$count, 'bootstrap_pagination',0,'halaman');
            $data['pager'] = $pager;
            $data['page_title'] = "Daftar Halaman";
            return view('admin/page/list', $data);
        }else{
            return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        }
    }

    public function update_page(){
        $request = service('request');
        if(in_array('page',session()->permission) or in_array($request->getGet('key'),session()->permission)){
            $data['is_superadmin'] = ($request->getGet('key')==null);
            $data['data'] = $this->page_model->geteditpage($request->getGet('id'));
            $data['page_title'] = "Edit Halaman - ".$request->getGet('page');
            $data['summernote'] = true;
            return view('admin/page/edit', $data);
        }else{
            return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        }
    }

    public function updatepage(){
        if(in_array('page',session()->permission) or in_array($this->request->getPost('url'),session()->permission)){
            //save image
            if (!$this->validate([
                'id_post' => [
                    'rules' => 'required|is_not_unique[tbl_page.id_post]',
                    'errors' => [
                        'required' => '{field} Eror silahkan reload halaman ini'
                    ]
                ],
                'judul' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong',
                        'max_length' => '{field} Terlalu Panjang'
                    ]
                ],
                'header' => [
                    'rules' => 'mime_in[header,image/jpg,image/jpeg,image/gif,image/png]|max_size[header,2048]',
                    'errors' => [
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ],
                'content' => [
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong',
                        'min_length' => '{field} Terlalu pendek'
                    ]
                ],
                'url' => [
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'required' => '{field} Tidak boleh kosong',
                        'min_length' => '{field} Terlalu pendek'
                    ]
                ]

            ])){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $upload = $this->request->getFile('header');
            $data = array(
                'post_author' => session()->id_user,
                'post_date' =>  $this->request->getPost('tanggal'), 
                'post_content' => $this->request->getPost('content'), 
                'post_title' => $this->request->getPost('judul'), 
                'post_name' => str_replace(' ', '-', strtolower($this->request->getPost('url'))),
                'post_type' => 'page', 
            );
            if($upload->isValid()){
                $old = explode('/',$this->request->getPost('old_photo'));
                $old = $old[count($old)-1];
                if(is_file('assets/img/upload/'.$old)) unlink('assets/img/upload/'.$old);
                if(is_file('assets/img/upload/thumbnail/'.$old)) unlink('assets/img/upload/thumbnail/'.$old);
                $fileName = date("Y-m-d.h.i.s").'_page.'.$upload->getClientExtension();
                $upload->move('assets/img/upload/', $fileName);
                $tmbl = \Config\Services::image()
                ->withFile('assets/img/upload/'.$fileName)
                ->resize(150, 150, true, 'height')
                ->save('assets/img/upload/thumbnail/'. $fileName);
                $data['post_header'] =  base_url("assets/img/upload/$fileName"); 
                $data['thumbnail'] =  base_url("assets/img/upload/thumbnail/$fileName"); 
            }
            $data = $this->page_model->updatepost($data, $this->request->getPost('id_post'));
            return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', "Berhasil Memperbarui halaman");
        }else{
            return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        }
    }

    public function adminpage($param){
        if(!in_array($param,session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->page_model->getpostid($param);
        return redirect()->to(base_url('cms/update_page?key='.$data[0]->post_name.'&id='.$data[0]->id_post.'&page='.$data[0]->post_title));
    }
}