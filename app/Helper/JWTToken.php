<?php

namespace App\Helper;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function generateToken($tokenName = 'JWT Token', $email, $id, $expTime)
    {
        $key = env('JWT_KEY', 'ABC123XYZ');
        $data = [
            'iss' => $tokenName,
            'email' => $email,
            'id' => $id,
            'iat' => time(),
            'exp' => time() + $expTime,
        ];
        return JWT::encode($data, $key, 'HS256');
    }




    // public static function CreateToken($userEmail, $userID): string
    // {
    //     $key = env('JWT_KEY');
    //     $payload = [
    //         'iss' => 'laravel-token',
    //         'iat' => time(),
    //         'exp' => time() + 60 * 60,
    //         'userEmail' => $userEmail,
    //         'userID' => $userID

    //     ];

    //     return JWT::encode($payload, $key, 'HS256');
    // }

    // public static function CreateTokenForSetPassword($userEmail): string
    // {
    //     $key = env('JWT_KEY');
    //     $payload = [
    //         'iss' => 'laravel-token',
    //         'iat' => time(),
    //         'exp' => time() + 60 * 20,
    //         'userEmail' => $userEmail,
    //         'userID' => '0'
    //     ];

    //     return JWT::encode($payload, $key, 'HS256');
    // }

    // public static function VerifyToken($token): string|object
    // {
    //     try {
    //         if ($token == null) {
    //             return "unauthorized";
    //         } else {
    //             $key = env('JWT_KEY');
    //             $decode = JWT::decode($token, new Key($key, 'HS256'));
    //             return $decode;
    //         }

    //     } catch (Exception $e) {
    //         return 'unauthorized';
    //     }



    // }



    public static function decodeToken($token)
    {
        try {
            if ($token == null) {
                return "Unauthorized";
            } else {
                $key = env('JWT_KEY', 'ABC123XYZ');
                $decode = JWT::decode($token, new Key($key, 'HS256'));
                return $decode;
            }
        } catch (Exception $e) {
            // return response()->json([
            //     'status' => 'failed',
            //     'message' => $e->getMessage(),
            // ]);

            return "Unauthorized";
        }
    }

}
