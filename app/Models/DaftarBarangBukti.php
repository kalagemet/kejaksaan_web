<?php

namespace App\Models;
 
use CodeIgniter\Model;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

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

    public function getDaftarBarangBukti($select = ['*'],$publik = false,$order = null, $dir=null, $limit=null, $start=null, $search=null){
        $data = new DaftarBarangBukti();
        $data = $data->select($select)->where('deleted_at is null');
        if($order != null && $dir!=null){
            $data = $data->orderBy($order, $dir);
        }
        if($search != null){
            $data = $data->like('jenis', $search)
            ->orLike('register_perkara', $search)
            ->orLike('register_barang', $search);
        }
        if($limit != null && $start!=null){
            $data = $data->limit($limit, $start);
        }
        if($publik) $data = $data->where("is_release = 1");
        return $data;
    }
 
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
            $data->select()->where('id_barang',$id);
            $data->set('is_release','CASE WHEN is_release = 1 THEN 0 ELSE 1 END');
            $data->update();
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