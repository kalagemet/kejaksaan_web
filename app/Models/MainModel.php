<?php

namespace App\Models;
 
use CodeIgniter\Model;
 /**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class MainModel extends Model
{
    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->jadwal_sidang = $this->db->table('tbl_jadwalsidangpidum');
    }

    public function getHeaderImage(){
        $data = $this->db;
        $data = $data->table('tbl_header')->select(['id_image','path'])->where('is_show','1')->where('deleted_at is null')->orderBy('created_at ASC')->get();
        return $data->getResult();
    }

    public function getHeaderImageAll(){
        $data = $this->db;
        $data = $data->table('tbl_header')->select(['id_image','path','is_show','created_at'])->where('deleted_at is null')->orderBy('created_at ASC')->get();
        return $data->getResult();
    }
    
    public function getVariable($param, $full = false){
        $string = 'value';
        if($full) $string = '*';
        $data = $this->db;
        $data = $data->table('tbl_env')->select($string)->where('variable',$param)->limit(1)->get();
        return $data->getResult();
    }

    public function setVariable($param, $value){
        try {
            $data = $this->db->table('tbl_env');
            $status = $data->select('id')->where('variable', $param)->limit(1)->get()->getResult();
            if($status){
                $data = $data->set('value',$value)->where('variable',$param)->update();
            }
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function setStatusCarousel($id){
        try {
            $data = $this->db->table('tbl_header');
            $status = $data->select('is_show')->where('id_image',$id)->limit(1)->get()->getResult();
            if($status[0]->is_show==='1'){
                $data = $data->set('is_show','0')->where('id_image',$id)->update();
            }else{
                $data = $data->set('is_show','1')->where('id_image',$id)->update();
            }
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function deleteCarousel($id){
        try {
            $data = $this->db->table('tbl_header');
            $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id_image',$id)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function saveCarousel($param){
        try {
            $data = $this->db->table('tbl_header');
            $data->set('id_image','UUID()', FALSE);
            $data->insert($param);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function getEnvironment(){
        $data = $this->db;
        $data = $data->table('tbl_env')->select([
            'id',
            'variable',
            'value',
            'type'
        ])->get();
        return $data->getResult();
    }

    public function saveEnv($var, $val){
        try{
            $data = $this->db->table('tbl_env');
            $data->set('value',$val);
            $data->where('variable',$var);
            $data->update();
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function saveLaporan($param){
        try {
            $data = $this->db->table('tbl_laporan');
            $data->set('id_laporan','UUID()', FALSE);
            $data->insert($param);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function getKategoriLapdu(){
        $data = $this->db;
        $data = $data->table('tbl_lapdu_kategori')->select([
            'id',
            'kategori',
            'keterangan'
        ])->get();
        return $data->getResult();
    }

    public function ticketLapduExist($key){
        $this->db->table('tbl_lapdu_laporan')->where('tiket',$key);
        $query = $this->db->table('tbl_lapdu_laporan')->where('tiket',$key)->get();
        if ($query->getNumRows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function saveLapdu($param){
        try {
            $data = $this->db->table('tbl_lapdu_laporan');
            $data->set('id_lapdu','UUID()', FALSE);
            $data->insert($param);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function getTiket($tiket){
        $data = $this->db;
        $data = $data->table('tbl_lapdu_laporan')->select([
            "id_lapdu", 
            "uraian", 
            "tiket", 
            "is_priority", 
            "is_pending", 
            "created_at",
        ])->where("deleted_at is NULL")
            ->where("is_active = 1")
            ->orderBy('created_at','DESC')->get();
        return $data->getResult();
    }

    public function getTindakLanjut($id){
        $data = $this->db;
        $data = $data->table('tbl_lapdu_tindakan')->select([
            "tindakan", 
            "oleh", 
            "created_at"
        ])->where("id_laporan",$id)
            ->where("deleted_at IS NULL")
            ->orderBy('created_at','DESC')->get();
        return $data->getResult();
    }

    public function getJabatanPegawai(){
        $data = $this->db;
        $data = $data->table('tbl_jabatan')->select([
            "id_jabatan", 
            "nama_jabatan", 
        ])->orderBy('struktur','ASC')->get();
        return $data->getResult();
    }
    public function getPangkatPegawai(){
        $data = $this->db;
        $data = $data->table('tbl_pangkat')->select([
            "id_pangkat", 
            "nama_pangkat", 
            "pangkat_jaksa" 
        ])->orderBy('golongan','DESC')->get();
        return $data->getResult();
    }
    public function getPendidikanPegawai(){
        $data = $this->db;
        $data = $data->table('tbl_jabatan')->select([
            "id_jabatan", 
            "nama_jabatan", 
        ])->orderBy('struktur','ASC')->get();
        return $data->getResult();
    }
    public function getStatusPegawai(){
        $data = $this->db;
        $data = $data->table('tbl_status')->select([
            "id_status", 
            "nama_status", 
        ])->orderBy('index','ASC')->get();
        return $data->getResult();
    }
}