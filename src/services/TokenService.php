<?php
require_once __DIR__ . '/../helpers/CurlHelper.php';

class TokenService {
    public static function generateToken() {
        $url = "http://api.herandro.lat/api/admin/get-token";
        $body = [
            "email" => "jose.alvarado220@hotmail.com",
            "password" => "gonzales220"
        ];

        $token = CurlHelper::post($url, $body);

        if (
            !is_object($token) ||
            !isset($token->data) ||
            !isset($token->data->expired_token)
        ) {
            error_log("⚠️ TokenService: respuesta inválida.");
            return null;
        }

        return $token->data->expired_token;
    }
}