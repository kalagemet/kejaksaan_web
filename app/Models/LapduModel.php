<?php

namespace App\Models;
 
use CodeIgniter\Model;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class LapduModel extends Model
{
    protected $table      = 'tbl_lapdu_laporan';
    protected $primaryKey = 'id_lapdu';

    protected $allowedFields = [
        "id_lapdu", 
        "kategori", 
        "nama_pelapor", 
        "nik", 
        "email", 
        "tlp", 
        "uraian", 
        "data", 
        "tiket", 
        "is_active", 
        "is_priority", 
        "is_pending", 
        "deleted_at"
    ];

    public function getLaporan($param = "*", $order = null, $dir=null, $limit=null, $start=null, $search=""){
        $data = new LapduModel();
        $data = $data->select($param)->join('tbl_lapdu_kategori','tbl_lapdu_kategori.id=tbl_lapdu_laporan.kategori', 'left')
        ->where('tbl_lapdu_laporan.deleted_at is null');
        if($search!=""){
            $data= $data->groupStart()->like('nama_pelapor', $search)
            ->orLike('tbl_lapdu_kategori.kategori', $search)
            ->orLike('tiket', $search)
            ->orLike('uraian', $search)->groupEnd();
        }
        if($order != null && $dir!=null){
            $data = $data->orderBy($order, $dir);
        }else{
            $data = $data->orderBy("is_priority",'DESC')->orderBy("tbl_lapdu_laporan.created_at",'DESC');
        }
        if($limit != null && $start!=null){
            $data = $data->limit($limit, $start);
        }
        return $data;
    }

    public function setStatus($param, $value){
        try {
            $data = new LapduModel();
            $data = $data->select()->where('id_lapdu',$value);
            $data->set($param, "CASE WHEN $param = 1 THEN 0 ELSE 1 END", false)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}