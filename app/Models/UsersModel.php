<?php

namespace App\Models;
 
use CodeIgniter\Model;
 /**
 * Use the fully-qualified AllowDynamicProperties, otherwise the #[AllowDynamicProperties] attribute on "MyClass" WILL NOT WORK.
 */
use \AllowDynamicProperties;

#[AllowDynamicProperties]

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