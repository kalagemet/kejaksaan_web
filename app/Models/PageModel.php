<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class PageModel extends Model
{
    protected $table      = 'tbl_page';
    protected $primaryKey = 'id_post';

    protected $allowedFields = [
        'id_post',
        'post_status',
        'deleted_at',
        'post_author',
        'post_date', 
        'post_content', 
        'post_header', 
        'post_title', 
        'tags', 
        'thumbnail', 
        'post_status',
        'ping_status',
        'post_name',
        'post_type',
        'post_modified'
    ];
 
    public function getPage($param){
        $data = new PageModel();
        $data = $data->select([
            "post_author","IF(post_modified > post_date, DATE_FORMAT(post_modified,'%d %M %Y'), DATE_FORMAT(post_date,'%d %M %Y')) as post_modified","DATE_FORMAT(post_date,'%d %M %Y') as post_date","post_content","post_title","post_header"
        ])->where('post_name',$param)->where('deleted_at is null')->where('post_status',"publish")->where('post_type',"page")->limit(1)->get();
        return $data->getResult();
    }

    public function getListPage($date = null,$string = null){
        $data = new PageModel();
        $data = $data->select([
            "id_post","post_author","post_name","DATE_FORMAT(post_date,'%d %M %Y') as tanggal", "post_status", "DATE_FORMAT(post_modified,'%d %M %Y') as post_edit","post_title","post_header","post_name"
        ])->where('post_type',"page")->where('deleted_at is null');
        if($date){
            $data = $data->where("MONTH(post_date)",date('m',$date))->where("YEAR(post_date)", date('Y',$date));
        }if($string){
            $data = $data->where("post_title like '%$string%' or post_content like '%$string%' or tags like '%$string%'");
        }
        $data->orderby("post_date DESC");
        return $data;
    }

    public function getListBerita($date = null,$string = null,$tag = null){
        $data = new PageModel();
        $data = $data->select([
            "id_post","post_author","thumbnail","DATE_FORMAT(post_date,'%d %M %Y') as tanggal","post_title","post_header","post_name"
        ])->where('post_status',"publish")->where('post_type',"post")->where('deleted_at is null');
        if($date){
            $data = $data->where("MONTH(post_date)",date('m',$date))->where("YEAR(post_date)", date('Y',$date));
        }if($string){
            $data = $data->where("post_title like '%$string%' or post_content like '%$string%' or tags like '%$string%'");
        }if($tag){
            $data = $data->where("tags like '%$tag%'");
        }
        $data->orderby("post_date DESC");
        return $data;
    }

    public function getListBeritaAll($date = null,$string = null,$tag = null){
        $data = new PageModel();
        $data = $data->select([
            "id_post","post_author","DATE_FORMAT(post_date,'%d %M %Y') as tanggal", "post_status", "DATE_FORMAT(post_modified,'%d %M %Y') as post_edit","post_title","post_header","post_name"
        ])->where('deleted_at is null')->where('post_type',"post");
        if($date){
            $data = $data->where("MONTH(post_date)",date('m',$date))->where("YEAR(post_date)", date('Y',$date));
        }if($string){
            $data = $data->where("post_title like '%$string%' or post_content like '%$string%' or tags like '%$string%'");
        }if($tag){
            $data = $data->where("tags like '%$tag%'");
        }
        $data->orderby("post_date DESC");
        return $data;
    }

    public function getBerita($param){
        $data = new PageModel();
        $data = $data->select([
            "post_author","IF(post_modified > post_date, DATE_FORMAT(post_modified,'%d %M %Y'), DATE_FORMAT(post_date,'%d %M %Y')) as post_modified","DATE_FORMAT(post_date,'%d %M %Y') as post_date","post_content","tags","post_title","post_header"
        ])->where('deleted_at is null')->where('post_name',$param)->where('post_status',"publish")->where('post_type',"post")->limit(1)->get();
        return $data->getResult();
    }

    public function getCountBerita(){
        $data = new PageModel();
        $data = $data->select([
            'COUNT(*) as jml, MONTHNAME(post_date) as bln, MONTH(post_date) as bln_num, YEAR(post_date) as thn'
        ])->where('deleted_at is null')->where("post_status='publish' AND post_type='post'")
        ->groupBy("bln, bln_num, thn")
        ->orderBy("YEAR(post_date) DESC, MONTH(post_date) DESC")
        ->get();
        return $data->getResult();
    }

    public function getYearCountBerita(){
        $data = new PageModel();
        $data = $data->select([
            'DISTINCT YEAR(post_date) as thn'
        ])->where('deleted_at is null')->where("post_status='publish' AND post_type='post'")
        ->groupBy("MONTH(post_date), YEAR(post_date)")
        ->orderBy("YEAR(post_date) DESC")
        ->get();
        return $data->getResult();
    }

    public function getTagsBerita($param){
        $data = new PageModel();
        $data = $data->select('tags')->where('post_name',$param)->limit(1)->get();
        return $data->getResult();
    }

    public function setStatusPage($id){
        try {
            $data = new PageModel();
            $status = $data->select('post_status')->where('id_post',$id)->limit(1)->get()->getResult();
            if($status[0]->post_status==='draf'){
                $data = $data->set('post_status','publish')->where('id_post',$id)->update();
            }else{
                $data = $data->set('post_status','draf')->where('id_post',$id)->update();
            }
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function deletePage($id){
        try {
            $data = new PageModel();
            $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id_post',$id)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function savepost($param){
        try {
            $data = new PageModel();
            $data->set('id_post','UUID()', FALSE);
            $data->insert($param);
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function geteditpost($param){
        $data = new PageModel();
        // $data = $data->set($param);
        $data = $data->select([
            'id_post',
            'post_header',
            "thumbnail",
            'post_date', 
            'post_content', 
            'post_title', 
            'tags', 
        ])->where('id_post',$param)->limit(1)->get();
        return $data->getResult();
    }

    public function updatepost($param, $id){
        try {
            $data = new PageModel();
            $data->set($param);
            $data->set('post_modified','NOW()', FALSE);
            $data->where('id_post',$id);
            $data->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public function geteditpage($param){
        $data = new PageModel();
        $data = $data->select([
            'id_post',
            'post_date', 
            'post_content', 
            'post_name', 
            'post_header', 
            "thumbnail",
            'post_title', 
        ])->where('id_post',$param)->limit(1)->get();
        return $data->getResult();
    }
}