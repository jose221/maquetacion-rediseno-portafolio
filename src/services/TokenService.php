<?php
require_once __DIR__ . '/../helpers/CurlHelper.php';

class TokenService {
    public static function generateToken() {
        //$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoiIGRldmVsb3BtZW50IiwiZG9tYWluIjoiIGh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCIsInVzZXJfaWQiOiIxIiwiaWF0IjoxNzUwNjQ5NDExfQ.T8MFbldCdISAfdB2HMNgfkZrXAdKhGQWE9avrH5udxA";
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtb2RlIjoicHJvZHVjdGlvbiIsImRvbWFpbiI6Imh0dHBzOi8vam9zZWFsdmFyYWRvLmhlcmFuZHJvLmxhdCIsInVzZXJfaWQiOiIxIiwiaWF0IjoxNzUzODQ3MzAyfQ.5LN-MT_x-FRPoQdmXuphIRhZa9gHbSc6ldGSkpEgv4I";
        return $token;
    }
}