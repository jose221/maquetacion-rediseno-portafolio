<?php
require_once __DIR__ . '/../helpers/CurlHelper.php';

class TokenService {
    public static function generateToken() {
        //$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoiIGRldmVsb3BtZW50IiwiZG9tYWluIjoiIGh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCIsInVzZXJfaWQiOiIxIiwiaWF0IjoxNzUwNjQ5NDExfQ.T8MFbldCdISAfdB2HMNgfkZrXAdKhGQWE9avrH5udxA";
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoiIHByb2R1Y3Rpb24iLCJkb21haW4iOiIgaHR0cHM6Ly9qb3NlYWx2YXJhZG8uaGVyYW5kcm8ubGF0IiwidXNlcl9pZCI6IjEiLCJpYXQiOjE3NTM4MzAyNzJ9.kCcwdkiST7hObyacKWC2g1GJmlTh5YBJOYs26JSwTRk";
        return $token;
    }
}