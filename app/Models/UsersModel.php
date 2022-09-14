<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class UsersModel extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id_user';
 
    public function getUser(){
        $data = new UsersModel();
        $data = $data->select('*')->where('is_active = 1');
        return $data;
    }
}