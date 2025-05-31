<?php
require_once __DIR__ . '/../helpers/CurlHelper.php';

class TokenService {
    public static function generateToken() {
        $url = "https://api.herandro.lat/api/admin/get-token";
        $body = [
            "email" => "jose.alvarado220@hotmail.com",
            "password" => "gonzales220"
        ];

        $token = CurlHelper::post($url, $body);

        // Validar si hubo error
        if (!is_object($token)) {
            error_log("❌ CurlHelper::post devolvió null o una respuesta no válida.");
            return null;
        }

        if (!isset($token->data)) {
            error_log("❌ La respuesta no contiene 'data'. Respuesta: " . json_encode($token));
            return null;
        }

        if (!isset($token->data->expired_token)) {
            error_log("❌ 'expired_token' no existe en la respuesta.");
            return null;
        }

        return $token->data->expired_token;
    }
}