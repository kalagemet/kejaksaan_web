<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class TindakanModel extends Model
{
    protected $table      = 'tbl_lapdu_tindakan';
    protected $primaryKey = 'id_tindakan';

    protected $allowedFields = [
        "id_tindakan", 
        "id_laporan", 
        "tindakan", 
        "oleh", 
        "deleted_at"
    ];
    
    public function hapusTindakan($param){
        try {
            $data = new TindakanModel();
            $data = $data->select()->where('id_laporan',$param)->where('deleted_at is null')->orderBy('created_at','DESC')->limit(1);
            $data->set('deleted_at', "CURDATE()", false)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function tambahTindakan($param){
        try {
            $data = new TindakanModel();
            $data->set('id_tindakan','UUID()', FALSE);
            $data->insert($param);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}