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
        $data = $data->table('tbl_header')->select(['id_image','path'])->where('is_show','1')->get();
        return $data->getResult();
    }
    
    public function getRunningText(){
        $data = $this->db;
        $data = $data->table('tbl_env')->select('running_text')->limit(1)->get();
        return $data->getResult();
    }

    public function getDisplayTimeout(){
        $data = $this->db;
        $data = $data->table('tbl_env')->select('display_timeout')->limit(1)->get();
        return $data->getResult();
    }

    public function getDisplayGallery(){
        $data = $this->db;
        $data = $data->table('tbl_env')->select('slider_display')->limit(1)->get();
        return $data->getResult();
    }

    public function getJadwalSidang($param){
        $data = $this->db;
        $data = $data->table('tbl_jadwalsidangpidum')->select([
            'id_jadwal',
            'terdakwa', 
            '(SELECT GROUP_CONCAT(nama," <br/>") FROM tbl_pegawai LEFT JOIN tbl_jpu on tbl_pegawai.id_pegawai=tbl_jpu.id_pegawai WHERE tbl_jpu.id_sidang = id_jadwal) as jaksa', 
            "DATE_FORMAT(tanggal, '%d %M %Y Jam %H:%i') as tanggal", 
            'agenda',
            'pasal',
            'keterangan'
        ])->where('deleted_at is null')->where("MONTH(tanggal) = '$param'")->orderBy('tanggal DESC')->get();
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
}