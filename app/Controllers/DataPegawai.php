<?php

namespace App\Controllers;
use App\Models\PegawaiModel;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class DataPegawai extends BaseController{
    public function __construct(){
        $this->pegawai = new PegawaiModel();
    }

    public function index(){
        return "Forbiden";
    }

    public function struktur(){
        $data['page_title'] = "Struktur Organisasi Kejaksaan Negeri Boalemo";
        $data['data'] = $this->pegawai->getStruktural();
        return view('public/struktur', $data);
    }
}