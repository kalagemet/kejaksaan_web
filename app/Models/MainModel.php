<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class MainModel extends Model
{
    public function __construct(){
        $this->db = \Config\Database::connect();
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

    public function getJadwalSidang($param, $all = true, $is_pidum = true){
        $data = $this->db;
        $data = $data->table('tbl_jadwalsidangpidum')->select([
            'id_jadwal',
            'terdakwa', 
            '(SELECT GROUP_CONCAT(nama," <br/>") FROM tbl_pegawai LEFT JOIN tbl_jpu on tbl_pegawai.id_pegawai=tbl_jpu.id_pegawai WHERE tbl_jpu.id_sidang = id_jadwal) as jaksa', 
            "DATE_FORMAT(tanggal, '%d %M %Y Jam %H:%i') as tanggal", 
            'agenda',
            'pasal',
            'lokasi_sidang',
            'is_pidum',
            'keterangan'
        ])->where('deleted_at is null')->where("MONTH(tanggal) = '$param'");
        if(!$all){
            if($is_pidum) $data = $data->where("is_pidum = 1");
            else $data = $data->where("is_pidum = 0");
        }
        $data = $data->orderBy('tanggal','DESC')->get();
        return $data->getResult();
    }

    public function getJadwalSidangHariIni(){
        $data = $this->db;
        $data = $data->table('tbl_jadwalsidangpidum')->select([
            'id_jadwal',
            'terdakwa', 
            '(SELECT GROUP_CONCAT(nama," <br/>") FROM tbl_pegawai LEFT JOIN tbl_jpu on tbl_pegawai.id_pegawai=tbl_jpu.id_pegawai WHERE tbl_jpu.id_sidang = id_jadwal) as jaksa', 
            "DATE_FORMAT(tanggal, '%d %M %Y Jam %H:%i') as tanggal", 
            'agenda',
            'pasal',
            'lokasi_sidang',
            'is_pidum',
            'keterangan'
        ])->where('deleted_at is null')->where("tanggal = NOW()")->orderBy('tanggal','DESC')->get();
        return $data->getResult();
    }

    public function getDaftarBarangBukti($publik = false){
        $data = $this->db;
        $data = $data->table('tbl_barangbukti')->select([
            'id_barang', 
            'terdakwa', 
            'register_perkara',
            'register_barang',
            'jenis',
            'no_putusan',
            'amar_putusan',
            'tgl_putusan',
            'keterangan',
            'is_release'
        ])->where('deleted_at is null');
        if($publik) $data = $data->where("is_release = 1");
        $data = $data->orderBy('register_barang','ASC')->get();
        return $data->getResult();
    }

    public function setJadwalSidang($param, $jaksa = []){
        try {
            $data = $this->db->table('tbl_jadwalsidangpidum');
            $id = $data->select("UUID() as id")->get()->getResult();
            $id = $id[0]->id;
            $data->set('id_jadwal',$id);
            $data->insert($param);
            foreach($jaksa as $row){
                $tmp = array(
                    'id_sidang' => $id,
                    'id_pegawai' => $row
                );
                $tmp = $this->db->table('tbl_jpu')
                ->set('id_jpu','UUID()', FALSE)
                ->insert($tmp);
            }
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function hapusJadwal($param){
        try {
            $data = $this->db->table('tbl_jadwalsidangpidum');
            $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id_jadwal',$param)->update();
            if($data){
                $data = $this->db->table('tbl_jpu');
                $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id_sidang',$param)->update();
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
}