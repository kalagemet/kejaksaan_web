<?php

namespace App\Models;
 
use CodeIgniter\Model;
/**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

class PegawaiModel extends Model
{
    protected $table      = 'tbl_pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $allowedFields = [
        'id_pegawai', 
        'nama', 
        'nip', 
        'nrp', 
        'tmt_pns',
        'karpeg',
        'jabatan',
        'pangkat',
        'tmt_pangkat',
        'pendidikan',
        'tmt_satker',
        'status',
        'is_active',
        'deleted_at'
    ];

    public function getPegawai($param = ['*'], $order = null, $dir=null, $limit=null, $start=null, $search="", $all = false, $deleted = false, $status = null, $jabatan = null){
        $data = new PegawaiModel();
        $data = $data->select($param)
        ->groupStart()->join("tbl_status","tbl_pegawai.status=tbl_status.id_status","left"
        )->join("tbl_pangkat","tbl_pegawai.pangkat=tbl_pangkat.id_pangkat","left"
        )->join("tbl_pendidikan","tbl_pegawai.pendidikan=tbl_pendidikan.id_pendidikan","left"
        )->join("tbl_gelar","tbl_pendidikan.id_gelar=tbl_gelar.id_gelar","left"
        )->join("tbl_jabatan","tbl_jabatan.id_jabatan=tbl_pegawai.jabatan","left")
        ->like('tbl_pegawai.nama', $search)
        ->orLike('tbl_pegawai.nrp', $search)
        ->orLike('tbl_jabatan.nama_jabatan', $search)
        ->orLike('tbl_pegawai.nip', $search)->groupEnd();
        if(!$all) $data = $data->where("tbl_pegawai.is_active", 1);
        if($status != null){
            if($status == "JAKSA" || $status == 'jaksa') $data = $data->where('tbl_status.nama_status',"JAKSA");
            else if($status == "TU" || $status == 'tu') $data = $data->where('tbl_status.nama_status !=',"JAKSA");
        }
        if($jabatan != null){
            if($jabatan == "STRUKTURAL" || $jabatan == 'struktural') $data = $data->where('tbl_jabatan.struktur NOT IN (0,8)');
            else if($jabatan == "FUNGSIONAL" || $jabatan == 'fungsional') $data = $data->where('tbl_jabatan.struktur',8);
            else if($jabatan == "PELAKSANA" || $jabatan == 'pelaksana') $data = $data->where('tbl_jabatan.struktur',0);
        }
        if($deleted){
            $data = $data->where('tbl_pegawai.deleted_at is not null');
        }else{
            $data = $data->where("tbl_pegawai.deleted_at is null");
        }
        if($order != null && $dir!=null){
            $data = $data->orderBy($order, $dir);
        }else{
            $data = $data->orderBy("tbl_status.index ASC, tbl_pangkat.golongan DESC, tbl_pegawai.tmt_pangkat ASC, tbl_pegawai.tmt_pns ASC, tbl_pegawai.nip ASC, tbl_pegawai.nama ASC");
        }
        if($limit != null && $start!=null){
            $data = $data->limit($limit, $start);
        }
        return $data;
    }

    public function getPejabat(){
        $data = new PegawaiModel();
        $data = $data->select([
            'tbl_jabatan.nama_jabatan', 
            'COALESCE(tbl_pegawai.nama, "KOSONG") as nama',
            'tbl_pegawai.id_pegawai',
            'tbl_pegawai.nrp',
            'tbl_pegawai.nip',
            'IF(tbl_status.nama_status="JAKSA",tbl_pangkat.pangkat_jaksa,tbl_pangkat.nama_pangkat) as nama_pangkat'
        ])->join('tbl_jabatan','tbl_pegawai.jabatan=tbl_jabatan.id_jabatan AND tbl_pegawai.deleted_at is null','right')
        ->join('tbl_pangkat','tbl_pegawai.pangkat=tbl_pangkat.id_pangkat','left')
        ->join("tbl_status","tbl_pegawai.status=tbl_status.id_status","left")
        ->where('tbl_jabatan.struktur BETWEEN 1 AND 7')->orderBy('tbl_jabatan.struktur ASC')->get();
        return $data->getResult();
    }

    public function getStruktural(){
        $data = new PegawaiModel();
        $data = $data->select([
            'tbl_jabatan.nama_jabatan', 
            'COALESCE(tbl_pegawai.nama, "KOSONG") as nama',
            'tbl_pegawai.id_pegawai',
            'tbl_pegawai.nrp',
            'tbl_pegawai.nip',
            'IF(tbl_status.nama_status="JAKSA",tbl_pangkat.pangkat_jaksa,tbl_pangkat.nama_pangkat) as nama_pangkat',
            'tbl_jabatan.struktur',
            "DATE_FORMAT(tmt_satker,'%d %M %Y') as tmt"
        ])->join('tbl_jabatan','tbl_pegawai.jabatan=tbl_jabatan.id_jabatan AND tbl_pegawai.deleted_at is null','right')
        ->join("tbl_status","tbl_pegawai.status=tbl_status.id_status","left")
        ->join('tbl_pangkat','tbl_pegawai.pangkat=tbl_pangkat.id_pangkat','left')
        ->where('tbl_jabatan.grade != 0')->orderBy('tbl_jabatan.grade ASC, tbl_jabatan.id_jabatan ASC')->get();
        return $data->getResult();
    }

    public function getJaksa(){
        $data = new PegawaiModel();
        $data = $data->select([
            "tbl_pegawai.id_pegawai",
            "tbl_pegawai.nama",
            'tbl_pangkat.pangkat_jaksa as pangkat'
        ])->join("tbl_status","tbl_pegawai.status=tbl_status.id_status","left"
        )->join('tbl_pangkat','tbl_pegawai.pangkat=tbl_pangkat.id_pangkat','left'
        )->where("tbl_pegawai.is_active",1
        )->where("tbl_pegawai.deleted_at is null"
        )->where("tbl_status.nama_status='JAKSA'"
        )->orderBy("tbl_pegawai.nama ASC"
        )->get();
        return $data->getResult();
    }

    public function getDetailPegawai($param = '', $select = ['*']){
        $data = new PegawaiModel();
        $data = $data->select($select)->where('id_pegawai',$param)->get();
        return $data->getResult();
    }

    public function hapusPegawai($param){
        try {
            $data = new PegawaiModel();
            $data = $data->set('deleted_at',date("Y-m-d h:i:s"))->where('id_pegawai',$param)->update();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }
}