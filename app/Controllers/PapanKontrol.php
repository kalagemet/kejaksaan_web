<?php

namespace App\Controllers;
use App\Models\PapankontrolModel;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class PapanKontrol extends BaseController{
    public function __construct(){
        $this->papan_model = new PapankontrolModel();
    }

    public function index($param){
        if(!in_array('pembinaan',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        switch ($param) {
            case 'ptsp':
                $data['page_title'] = "Papan Kontrol PTSP Kejaksaan Negeri Boalemo";
                $data['slider'] = $this->papan_model->getValue($param,['id','value','type','created_at', 'is_active'], 'slider', false)->get()->getResult();
                $data['running'] = $this->papan_model->getValue($param,['id','value'], 'runningtext', false)->get()->getResult();
                $data['timeout'] = $this->papan_model->getValue($param,['id','value'], 'interval', false)->get()->getResult();
                break;
            default:
                return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Parameter salah");
        }
        return view('admin/papan-kontrol', $data);
    }

    public function setStatus($param){
        $request = service('request');
        if(!in_array('pembinaan',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->papan_model->setStatus($param);
        if($data){
            $msg = "Berhasil mengupdate data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function hapus($param){
        $request = service('request');
        if(!in_array('pembinaan',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->papan_model->hapus($param);
        if($data){
            $msg = "Berhasil menghapus data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function simpan($param){
        $request = service('request');
        if(!in_array('pembinaan',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        if(!in_array($param, ['ptsp'])) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Parameter salah");
        if (!$this->validate([
            'id_running' => [
				'rules' => 'required|is_not_unique[tbl_papankontrol.id]:',
            ],
            'id_timeout' => [
                'rules' => 'required|is_not_unique[tbl_papankontrol.id]',
            ]
        ])){
            //add database
            $data = array(
                "value" => $this->request->getPost('running'), 
                "type" => "text", 
                "label" => "runningtext", 
                "is_active" => 1,  
                "bidang" => $param
            );
            $data2 = array(
                "value" => $this->request->getPost('timeout'), 
                "type" => "time", 
                "label" => "interval", 
                "is_active" => 1,  
                "bidang" => $param
            );
            $act = $this->papan_model->tambah($data);
            $act2 = $this->papan_model->tambah($data2);
        }else{
            //save into database
            $act = $this->papan_model->setValue($this->request->getPost('id_timeout'),$this->request->getPost('timeout'));
            $act2 = $this->papan_model->setValue($this->request->getPost('id_running'),$this->request->getPost('running'));
        }
        if(!$act || !$act2){
            $msg = strval($act->getMessage())." ".strval($act2->getMessage());
        }else{
            $msg = "Berhasil";
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function tambah($param){
        $request = service('request');
        if(!in_array('pembinaan',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        if(!in_array($param, ['ptsp'])) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Parameter salah");
        if (!$this->validate([
            'upload' => [
				'rules' => 'uploaded[upload]|mime_in[upload,video/mp4,image/jpg,image/jpeg,image/gif,image/png]|max_size[upload,20971520]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa Foto / Video',
					'max_size' => 'Ukuran File Maksimal 5 MB (foto) 20 MB (video)'
				]
			]
		])){
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $upload = $this->request->getFile('upload');
        $data = array(
            "value" => base_url('/assets/img/no-image.svg'), 
            "type" => "image", 
            "label" => "slider", 
            "is_active" => 1,  
            "bidang" => $param
        );
        if(!$upload->isValid()){
            session()->setFlashdata('error', "Gagal menyimpan file");
			return redirect()->back()->withInput();
        }
        $fileName = date("Y-m-d.h.i.s").'_slider_ptsp.'.$upload->getClientExtension();
        $upload->move('media/upload/', $fileName);
        if(strstr($upload->getClientMimeType(), "video/")){
            $data["type"] = "video";
        }else{
            $tmbl = \Config\Services::image()
              ->withFile('media/upload/'.$fileName)
              ->resize(150, 150, true, 'height')
              ->save('media/upload/thumbnail/'. $fileName);
        }
        $data['value'] = $fileName;
        $act = $this->papan_model->tambah($data);
        if($act){
            $msg = "Berhasil";
        }else{
            $msg = $act->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }
}