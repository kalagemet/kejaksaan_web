<?php

namespace App\Models;
 
use CodeIgniter\Model;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class JadwalSidangModel extends Model
{
    protected $table      = 'tbl_jadwalsidangpidum';
    protected $primaryKey = 'id_jadwal';

    protected $allowedFields = [
        'id_jadwal',
        'id_user',
        'tanggal',
        'terdakwa',
        'pasal',
        'agenda',
        'lokasi_sidang',
        'is_pidum',
        'keterangan',
        'deleted_at'
    ];

    public function getJadwalSidang($param = "*", $bidang=null, $order = null, $dir=null, $limit=null, $start=null, $search=null){
        $data = new JadwalSidangModel();
        $data = $data->select($param)
        ->where('deleted_at is null')
        ->where('MONTH(tanggal) = MONTH(CURDATE())')
        ->where('YEAR(tanggal) = YEAR(CURDATE())');
        if($order != null && $dir!=null){
            $data = $data->orderBy($order, $dir);
        }else{
            $data = $data->orderBy('tanggal','ASC');
        }
        if($bidang=='pidum'){
            $data = $data->where('is_pidum = 1');
        }else if($bidang=='pidsus'){
            $data = $data->where('is_pidum = 0');
        }
        if($search != null){
            $data = $data->groupStart()->like('terdakwa', $search)->orLike('tanggal', $search)->groupEnd();
        }
        if($limit != null && $start!=null){
            $data = $data->limit($limit, $start);
        }
        return $data;
    }
 
    public function setJadwalSidang($param, $jaksa = []){
        try {
            $data = new JadwalSidangModel();
            $id = new JadwalSidangModel();
            $id = $id->select("UUID() as id")->get()->getResult();
            $id = $id[0]->id;
            $data->set('id_jadwal',$id);
            $data->set($param);
            $data->insert();
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
            $data = new JadwalSidangModel();
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