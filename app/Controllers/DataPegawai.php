<?php

namespace App\Controllers;
use App\Models\PegawaiModel;
use App\Models\MainModel;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class DataPegawai extends BaseController{
    public function __construct(){
        $this->pegawai = new PegawaiModel();
        $this->main = new MainModel();
    }

    public function index(){
        return "Forbiden";
    }

    public function daftar_pegawai(){
        $data['page_title'] = "Daftar Pegawai KN Boalemo";
        $data['page_header'] = "Kejari Boalemo";
        $data['datatables'] = true;
        return view('admin/pegawai/list', $data);
    }

    public function detail_pegawai($param){
        $data['page_title'] = "Pegawai KN Boalemo";
        $data['page_header'] = "Kejari Boalemo";
        $data['data'] = $this->pegawai->getDetailPegawai($param);
        $data['pangkat'] = $this->main->getPangkatPegawai();
        $data['status'] = $this->main->getStatusPegawai();
        $data['jabatan'] = $this->main->getJabatanPegawai();
        return view('admin/pegawai/detail', $data);
    }

    public function hapus_pegawai($param){
        $request = service('request');
        if(!in_array('pembinaan',session()->permission)) return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', "Akun tidak diizinkan");
        $data = $this->pegawai->hapusPegawai($param);
        if($data){
            $msg = "Berhasil menghapus data";
        }else{
            $msg = $data->getMessage();
        }
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', $msg);
    }

    public function struktur(){
        $data['page_title'] = "Struktur Organisasi Kejaksaan Negeri Boalemo";
        $data['data'] = $this->pegawai->getStruktural();
        return view('public/struktur', $data);
    }
}