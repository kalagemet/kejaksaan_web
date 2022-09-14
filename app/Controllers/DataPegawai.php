<?php

namespace App\Controllers;
use App\Models\PegawaiModel;

class DataPegawai extends BaseController{
    public function __construct(){
        $this->pegawai = new PegawaiModel();
    }

    public function index(){
        return "Forbiden";
    }
    public function getListPegawai(){
        $data['data'] = $this->pegawai->getListPegawai();
        echo json_encode($data);
    }

    public function struktur(){
        $data['page_title'] = "Struktur Organisasi Kejaksaan Negeri Boalemo";
        $data['data'] = $this->pegawai->getStruktural();
        return view('public/struktur', $data);
    }
}