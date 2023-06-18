<?php

namespace App\Models;
 
use CodeIgniter\Model;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class PapankontrolModel extends Model
{
    protected $table      = 'tbl_papankontrol';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        "id", "value", "type","label", "is_active", "bidang", "deleted_at"
    ];

    public function getValue($bidang = '', $param = ['*'], $type = '', $is_active = false, $order = null, $dir=null, $limit=null, $start=null, $search = ''){
        $data = new PapankontrolModel();
        $data = $data->select($param)
        ->where('tbl_papankontrol.label', $type)
        ->where('tbl_papankontrol.bidang', $bidang)
        ->where('tbl_papankontrol.deleted_at is null');
        if($search!=""){
            $data= $data->groupStart()->like('value', $search)
            ->orLike('created_at', $search)->groupEnd();
        }
        if($order != null && $dir!=null){
            $data = $data->orderBy($order, $dir);
        }else{
            $data = $data->orderBy("tbl_papankontrol.created_at",'DESC');
        }
        if($limit != null && $start!=null){
            $data = $data->limit($limit, $start);
        }
        if($is_active != null && $is_active){
            $data = $data->where('tbl_papankontrol.is_active = 1');
        }
        return $data;
    }

    public function setStatus($value){
        try {
            $data = new PapankontrolModel();
            $data = $data->select()->where('id',$value);
            $data->set('is_active', "CASE WHEN is_active = 1 THEN 0 ELSE 1 END", false)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function setValue($param, $value){
        try {
            $data = new PapankontrolModel();
            $data = $data->select()->where('id',$param);
            $data->set('value', $value)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function hapus($param){
        try {
            $data = new PapankontrolModel();
            $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id',$param)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function tambah($arr){
        try {
            $data = new PapankontrolModel();
            $data->set('id','UUID()', FALSE);
            $data->insert($arr);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}