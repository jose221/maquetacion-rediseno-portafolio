<?php
require_once __DIR__ . '/../helpers/CurlHelper.php';

class TokenService {
    public static function generateToken() {
        //$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoiIGRldmVsb3BtZW50IiwiZG9tYWluIjoiIGh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCIsInVzZXJfaWQiOiIxIiwiaWF0IjoxNzUwNjQ5NDExfQ.T8MFbldCdISAfdB2HMNgfkZrXAdKhGQWE9avrH5udxA";
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoiIHByb2R1Y3Rpb24iLCJkb21haW4iOiJodHRwczovL2pvc2VhbHZhcmFkby5oZXJhbmRyby5sYXQiLCJ1c2VyX2lkIjoiMSIsImlhdCI6MTc1MjM1MzI2Mn0.2cCK5VcnSMBtLlzhzciQAX2OM_qO15yqmJ3BUbjFLzQ";
        return $token;
    }
}