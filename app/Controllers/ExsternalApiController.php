<?php

namespace App\Controllers;
use App\Models\MainModel;

// secret site key recaptha = 6LcIhhsiAAAAADc8LeRwMX7KQlT6r2lHv0eaB3_s

class ExsternalApiController extends BaseController{
    public function __construct(){
        $this->main_model = new MainModel();
    }

    function getLongLiveToken(){
        $url = "https://graph.facebook.com/v4.0/oauth/access_token?grant_type=fb_exchange_token&client_id=";
        $url .= getenv('ID_INSTAGRAM');
        $url .= '&client_secret=';
        $url .= getenv('ID_INSTAGRAM_SECRET');
        $url .= '&fb_exchange_token=';
        $url .= getenv('ACCESS_TOKEN');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        error_log($result,0);
        if(property_exists($result, 'access_token')){ 
            //push token to db
            $this->main_model->setVariable('IG_TOKEN',$result->access_token);
            $this->main_model->setVariable('IG_TOKEN_EXP',date("Y-m-d H:i:s", time() + $result->expires_in));
            return $result->access_token;
        }
        curl_close($ch);
    }

    function getPostInstagram(){
        date_default_timezone_set('Asia/Jakarta');
        $token = $this->main_model->getVariable('IG_TOKEN_EXP',true);
        if(date("Y-m-d H:i:s") > date($token[0]->value)) $token = $this->getLongLiveToken();
        $token = $this->main_model->getVariable('IG_TOKEN')[0]->value;
        $url = "https://graph.instagram.com/me/media?fields=media_url&access_token=";
        $url .= $token;
        $url .= '&limit=5';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        if($result==null){ 
            $result = (Object) array(
                'data' => []
            );
        }else{
            $result = json_decode($result);
        }
        curl_close($ch);
        if(property_exists($result, 'data')) return $result->data;
        else{
            echo '<script>console.error(`Instagram => '.json_encode($result).'`);</script>';
            return [];
        }
    }
}