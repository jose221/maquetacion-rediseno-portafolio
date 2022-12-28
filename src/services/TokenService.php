<?php
require realpath($_SERVER["DOCUMENT_ROOT"]) . '/src/helpers/CurlHelper.php';
class TokenService{
    public static function generateToken(){
        $url = "http://localhost:8080/api/admin/get-token";
        $body = [
            "email" => "jose.alvarado220@hotmail.com",
            "password" => "gonzales220"
        ];
        $token = CurlHelper::post($url,$body);
        return $token;
    }
}