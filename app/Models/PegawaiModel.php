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
 
    public function getListPegawai(){
        $data = new PegawaiModel();
        $data = $data->select([
            "tbl_pegawai.id_pegawai",
            "tbl_pegawai.nama",
            "tbl_pegawai.nip",
            "tbl_pegawai.nrp",
            "tbl_jabatan.nama_jabatan as jabatan",
            "tbl_pegawai.tmt_pns",
            "tbl_pegawai.karpeg",
            "IF(tbl_status.nama_status='JAKSA',tbl_pangkat.pangkat_jaksa,tbl_pangkat.nama_pangkat) as pangkat",
            "tbl_pangkat.golongan",
            "tbl_pangkat.eselon",
            "tbl_pegawai.tmt_pangkat",
            "tbl_pegawai.tmt_satker",
            "tbl_gelar.nama_gelar",
            "tbl_pendidikan.jurusan",
            "tbl_pendidikan.asal_sekolah",
            "tbl_status.nama_status as status"
        ])->join("tbl_status","tbl_pegawai.status=tbl_status.id_status","left"
        )->join("tbl_pangkat","tbl_pegawai.pangkat=tbl_pangkat.id_pangkat","left"
        )->join("tbl_pendidikan","tbl_pegawai.pendidikan=tbl_pendidikan.id_pendidikan","left"
        )->join("tbl_gelar","tbl_pendidikan.id_gelar=tbl_gelar.id_gelar","left"
        )->join("tbl_jabatan","tbl_jabatan.id_jabatan=tbl_pegawai.jabatan","left"
        )->where("tbl_pegawai.is_active",1
        )->where("tbl_pegawai.deleted_at is null"
        )->orderBy("tbl_status.index ASC, tbl_pangkat.golongan DESC, tbl_pegawai.tmt_pangkat DESC, tbl_pegawai.tmt_pns DESC, tbl_pegawai.nama ASC"
        )->get();
        return $data->getResult();
    }

    public function getListPegawaiPublik(){
        $data = new PegawaiModel();
        $data = $data->select([
            "tbl_pegawai.id_pegawai",
            "tbl_pegawai.nama",
            // "tbl_pegawai.nip",
            // "tbl_pegawai.nrp",
            "tbl_jabatan.nama_jabatan as jabatan",
            "IF(tbl_status.nama_status='JAKSA',tbl_pangkat.pangkat_jaksa,tbl_pangkat.nama_pangkat) as pangkat",
            "tbl_pangkat.golongan",
            "tbl_pegawai.tmt_satker",
            "tbl_gelar.nama_gelar",
            "tbl_pendidikan.jurusan",
            "tbl_status.nama_status as status"
        ])->join("tbl_status","tbl_pegawai.status=tbl_status.id_status","left"
        )->join("tbl_pangkat","tbl_pegawai.pangkat=tbl_pangkat.id_pangkat","left"
        )->join("tbl_pendidikan","tbl_pegawai.pendidikan=tbl_pendidikan.id_pendidikan","left"
        )->join("tbl_gelar","tbl_pendidikan.id_gelar=tbl_gelar.id_gelar","left"
        )->join("tbl_jabatan","tbl_jabatan.id_jabatan=tbl_pegawai.jabatan","left"
        )->where("tbl_pegawai.is_active",1
        )->where("tbl_pegawai.deleted_at is null"
        )->orderBy("tbl_status.index ASC, tbl_pangkat.golongan DESC, tbl_pegawai.tmt_pangkat ASC, tbl_pegawai.tmt_pns ASC, tbl_pegawai.nip ASC, tbl_pegawai.nama ASC"
        )->get();
        return $data->getResult();
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
        ->where('tbl_jabatan.grade IN (1,2)')->orderBy('tbl_jabatan.struktur ASC')->get();
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
}