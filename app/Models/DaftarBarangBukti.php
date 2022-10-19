<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class DaftarBarangBukti extends Model
{
    protected $table      = 'tbl_barangbukti';
    protected $primaryKey = 'id_barang';

    protected $allowedFields = [
        'id_barang',
        'terdakwa', 
        'register_perkara',
        'register_barang',
        'jenis',
        'no_putusan',
        'amar_putusan',
        'tgl_putusan',
        'keterangan',
        'is_release',
        'id_user',
        'deleted_at'
    ];
 
    public function addbarang($param){
        try {
            $data = new DaftarBarangBukti();
            $data->set('id_barang','UUID()', FALSE);
            $data->insert($param);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function setStatus($id){
        try {
            $data = new DaftarBarangBukti();
            $status = $data->select('is_release')->where('id_barang',$id)->limit(1)->get()->getResult();
            if($status[0]->is_release){
                $data = $data->set('is_release','0')->where('id_barang',$id)->update();
            }else{
                $data = $data->set('is_release','1')->where('id_barang',$id)->update();
            }
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function hapus($id){
        try {
            $data = new DaftarBarangBukti();
            $data = $data->set('deleted_at',"NOW()", false)->where('id_barang',$id)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}