<?php
require realpath($_SERVER["DOCUMENT_ROOT"]) . '/src/helpers/CurlHelper.php';
class TokenService{
    public static function generateToken(){
        $url = "https://api.herandro.tech/api/admin/get-token";
        $body = [
            "email" => "jose.alvarado220@hotmail.com",
            "password" => "gonzales220"
        ];
        $token = CurlHelper::post($url,$body);
        return $token->data->expired_token;
    }
}