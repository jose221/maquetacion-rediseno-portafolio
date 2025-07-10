<?php
require_once __DIR__ . '/../helpers/CurlHelper.php';

class TokenService {
    public static function generateToken() {
        //$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoiIGRldmVsb3BtZW50IiwiZG9tYWluIjoiIGh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCIsInVzZXJfaWQiOiIxIiwiaWF0IjoxNzUwNjQ5NDExfQ.T8MFbldCdISAfdB2HMNgfkZrXAdKhGQWE9avrH5udxA";
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoiIHByb2R1Y3Rpb24iLCJkb21haW4iOiIgaHR0cHM6Ly93d3cuaGVyYW5kcm8ubGF0IiwidXNlcl9pZCI6IjEiLCJpYXQiOjE3NTA2NDk0MzF9.-VtKhQXgVXhzIT1WzKSKv8OaU3Zx_UQYQsABhhl0cxg";

        return $token;
    }
}