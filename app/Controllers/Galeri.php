<?php

namespace App\Controllers;
use App\Models\FotoModel;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class Galeri extends BaseController{
    public function __construct(){
        $this->galeri_model = new FotoModel();
    }

    public function list_galeri(){
        if(in_array('galeri',session()->permission)){
            $request = service('request');
            $pager = service('pager');
            $page = 1;
            $perPage = 10;
            $date = null;
            $string = null;
            if($request->getGet('page_galeri')>0) $page = (int) $request->getGet('page_galeri');
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
            $data['data'] = $this->galeri_model->getListGaleri($date, $string);
            $count = $this->galeri_model->getListGaleri($date, $string)->countAllResults();
            $data['data'] = $data['data']->paginate($perPage, 'galeri', $page);
            $pager->makeLinks($page,$perPage,$count, 'bootstrap_pagination',0,'galeri');
            $data['pager'] = $pager;
            $data['page_title'] = "Daftar Foto Galeri";
            return view('admin/galeri/list', $data);
        }else{
            return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        }
    }

    public function setstatus($id){
        if(!in_array('galeri',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        $data = $this->galeri_model->setStatus($id);
        if($data){
            $msg = "Berhasil mengupdate data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function delete($id){
        if(!in_array('galeri',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun anda tidak diizinkan");
        $data = $this->galeri_model->deleteFoto($id);
        if($data){
            $msg = "Berhasil menghapus data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function addfoto(){
        if(!in_array('galeri',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        $data['page_title'] = "Tambah Foto Galeri";
        // $data['page_header'] = "Tambah Postingan";
        return view('admin/galeri/add', $data);
    }

    public function editfoto(){
        if(!in_array('galeri',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
        $request = service('request');
        $data['data'] = $this->galeri_model->geteditfoto($request->getGet('id'));
        $data['page_title'] = "Edit Galeri - ".$request->getGet('string');
        return view('admin/galeri/edit', $data);
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

    public function add_foto($param){
        if(!in_array('galeri',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
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
		$fileName = date("Y-m-d.h.i.s").'_galeri.'.$upload->getClientExtension();
		$upload->move('assets/img/gallery/', $fileName);
        $tmbl = \Config\Services::image()
              ->withFile('assets/img/gallery/'.$fileName)
              ->resize(150, 150, true, 'height')
              ->save('assets/img/gallery/thumbnail/'. $fileName);
        $data = array(
            'id_author' => session()->id_user,
            'tanggal' =>  $this->request->getPost('tanggal'), 
            'path' =>  $fileName, 
            'judul' => $this->request->getPost('judul'), 
            'keterangan' => $this->request->getPost('keterangan'), 
            'tags' => $this->request->getPost('tags'), 
            'is_show' =>  $status,
        );
        $data = $this->galeri_model->saveFoto($data);
        return redirect()->to(base_url('/cms/gallery'))->with('success', "Berhasil menambahkan post");
    }

    public function updategambar($param){
        if(!in_array('galeri',session()->permission)) return redirect()->to(base_url('/cms'))->with('error', "Akun anda tidak diizinkan");
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
			'image' => [
				'rules' => 'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
			]
		])){
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $upload = $this->request->getFile('image');
        $data = array(
            'id_author' => session()->id_user,
            'tanggal' =>  $this->request->getPost('tanggal'), 
            'judul' => $this->request->getPost('judul'), 
            'keterangan' => $this->request->getPost('keterangan'), 
            'tags' => $this->request->getPost('tags'), 
            'is_show' =>  $status,
        );
        if($upload->isValid()){
            $old = explode('/',$this->request->getPost('old_photo'));
            $old = $old[count($old)-1];
            if(is_file('assets/img/gallery/'.$old)) unlink('assets/img/upload/'.$old);
            if(is_file('assets/img/gallery/thumbnail/'.$old)) unlink('assets/img/upload/thumbnail/'.$old);
            $fileName = date("Y-m-d.h.i.s").'_galeri.'.$upload->getClientExtension();
            $upload->move('assets/img/gallery/', $fileName);
            $tmbl = \Config\Services::image()
              ->withFile('assets/img/gallery/'.$fileName)
              ->resize(150, 150, true, 'height')
              ->save('assets/img/gallery/thumbnail/'. $fileName);
            $data['path'] =  base_url("assets/img/upload/$fileName"); 
        }
        $data = $this->galeri_model->updatefoto($data, $this->request->getPost('id_gambar'));
        return redirect()->to(base_url('/cms/gallery?filter_string='.$this->request->getPost('judul')))->with('success', "Berhasil menyimpan perubahan");
    }
}