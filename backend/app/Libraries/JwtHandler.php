<?php namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler
{
    private $secret;

    public function __construct()
    {
        $this->secret = getenv('JWT_SECRET'); // or getenv('JWT_SECRET')
    }

    public function generateToken($data, $exp = 3600)
    {
        $payload = [
            'iss' => 'localhost',
            'iat' => time(),
            'exp' => time() + $exp,
            'data' => $data
        ];

        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function decodeToken($token)
    {
        return JWT::decode($token, new Key($this->secret, 'HS256'));
    }
}
