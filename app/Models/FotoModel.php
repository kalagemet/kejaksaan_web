<?php

namespace App\Models;
 
use CodeIgniter\Model;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class FotoModel extends Model
{
    protected $table      = 'tbl_galeri';
    protected $primaryKey = 'id_gambar';

    protected $allowedFields = [
        'is_show',
        'id_author',
        'deleted_at',
        'id_gambar',
        'path',
        'judul',
        'tanggal',
        'modified',
        'tags',
        'keterangan',
        'is_show',
    ];
 
    public function getTerbaru(){
        $data = new FotoModel();
        $data = $data->select([
            "id_gambar","COALESCE(keterangan, 'Tidak Ada Keterangan') as keterangan","tanggal","path"
        ])->where('is_show', 'publish')->where('deleted_at is null')->orderBy('tanggal ASC')->limit(10)->get();
        return $data->getResult();
    }

    public function getGambar($date = null,$string = null, $tag = null){
        $data = new FotoModel();
        $data = $data->select([
            "id_gambar", "tags", "modified", "COALESCE(judul, 'Tidak Ada Keterangan') as judul","COALESCE(keterangan, 'Tidak Ada Keterangan') as keterangan","DATE_FORMAT(tanggal,'%d %M %Y') as tgl","deleted_at","path"
        ])->where('is_show', 'publish')->where('deleted_at is null');
        if($date){
            $data->where("MONTH(tanggal)",date('m',$date))->where("YEAR(tanggal)", date('Y',$date));
        }if($string){
            $data = $data->where("judul like '%$string%' or keterangan like '%$string%' or tags like '%$string%'");
        }if($tag){
            $data = $data->where("tags like '%$tag%'");
        }
        $data->orderby("tanggal","ASC");
        return $data;
    }

    public function getListGaleri($date = null,$string = null){
        $data = new FotoModel();
        $data = $data->select([
            "id_gambar","tags","modified","is_show","COALESCE(judul, 'Tidak Ada Keterangan') as judul","COALESCE(keterangan, 'Tidak Ada Keterangan') as keterangan","DATE_FORMAT(tanggal,'%d %M %Y') as tgl","deleted_at","path"
        ])->where('deleted_at is null');
        if($date){
            $data->where("MONTH(tanggal)",date('m',$date))->where("YEAR(tanggal)", date('Y',$date));
        }if($string){
            $data = $data->where("judul like '%$string%' or keterangan like '%$string%' or tags like '%$string%'");
        }
        $data->orderby("tanggal ASC");
        return $data;
    }

    public function setStatus($id){
        try {
            $data = new FotoModel();
            $status = $data->select('is_show')->where('id_gambar',$id)->limit(1)->get()->getResult();
            if($status[0]->is_show==='publish'){
                $data = $data->set('is_show','draf')->where('id_gambar',$id)->update();
            }else{
                $data = $data->set('is_show','publish')->where('id_gambar',$id)->update();
            }
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function deleteFoto($id){
        try {
            $data = new FotoModel();
            $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id_gambar',$id)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function saveFoto($param){
        try {
            $data = new FotoModel();
            $data->set('id_gambar','UUID()', FALSE);
            $data->insert($param);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function geteditfoto($param){
        $data = new FotoModel();
        $data = $data->select([
            'id_gambar',
            'date(tanggal) as tanggal', 
            'path', 
            'judul', 
            'keterangan', 
            'tags', 
        ])->where('id_gambar',$param)->limit(1)->get();
        return $data->getResult();
    }

    public function updatefoto($param, $id){
        try {
            $data = new PageModel();
            $data->set($param);
            $data->set('modified','NOW()', FALSE);
            $data->where('id_post',$id);
            return $data->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}