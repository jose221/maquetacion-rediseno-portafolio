<?php
require realpath("../")."/src/helpers/CurlHelper.php";
class TokenService{
    public static function generateToken(){
        $url = "http://api.herandro.lat/api/admin/get-token";
        $body = [
            "email" => "jose.alvarado220@hotmail.com",
            "password" => "gonzales220"
        ];
        $token = CurlHelper::post($url,$body);
        return $token->data->expired_token;
    }
}