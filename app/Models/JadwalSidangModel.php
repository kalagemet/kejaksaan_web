<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
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
        'keterangan'
    ];
 
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
            $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id_jadwal',$id)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}