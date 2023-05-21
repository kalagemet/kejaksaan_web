<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class LapduModel extends Model
{
    protected $table      = 'tbl_lapdu_laporan';
    protected $primaryKey = 'id_lapdu';

    protected $allowedFields = [
        "kategori", 
        "nama_pelapor", 
        "email", 
        "tlp", 
        "uraian", 
        "data", 
        "tiket", 
        "is_active", 
        "is_priority", 
        "is_pending", 
        "created_at", 
        "deleted_at"
    ];

    public function getLaporan($param = "*", $order = null, $dir=null, $limit=null, $start=null, $search=""){
        $data = new LapduModel();
        $data = $data->select($param)->join('tbl_lapdu_kategori','tbl_lapdu_kategori.id=tbl_lapdu_laporan.kategori', 'left')
        ->where('tbl_lapdu_laporan.deleted_at is null')
        ->like('nama_pelapor', $search)
        ->orLike('tbl_lapdu_kategori.kategori', $search)
        ->orLike('tiket', $search)
        ->orLike('uraian', $search);
        if($order != null && $dir!=null){
            $data = $data->orderBy($order, $dir);
        }else{
            $data = $data->orderBy("is_priority",'DESC')->orderBy("created_at",'DESC');
        }
        if($limit != null && $start!=null){
            $data = $data->limit($limit, $start);
        }
        return $data;
    }
}