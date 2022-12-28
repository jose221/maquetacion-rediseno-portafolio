<?php

//namespace TiquetesBaratos\helpers\curlHelper;
class CurlHelper
{
    public static function get($url, $method="get"){
        $url_curl = $url;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url_curl
        ));
        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;

    }
    public static function post($url, $body){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        $response = curl_exec($ch);
        return json_decode($response);
    }

    public static function getJson($url){
        $res = [];
        try {
            $data = json_decode(file_get_contents( $url),true);
            $res = [
                'code'=>200,
                'data'=>$data
            ];
        }catch (Exception $e) {
            $res = [
                'code'=>$e->getCode(),
                'data'=>[],
                'message'=> $e->getMessage()
            ];
        }
        return $res;
    }
}