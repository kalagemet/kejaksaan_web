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
        
    }

    public function index(){
        $data['page_title'] = "Papan Kontrol Kejaksaan Negeri Boalemo";
        $data['datatable'] = true;
        return view('admin/papan-kontrol', $data);
    }
}