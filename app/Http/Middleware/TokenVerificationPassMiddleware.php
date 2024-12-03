<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\JWTToken;

class TokenVerificationPassMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('passwordResetToken');
        if ($token == null) {
            return redirect()->route('auth.sign-in-page');
        }
        $result = JWTToken::decodeToken($token);
        if ($result == 'unauthorized') {
            return redirect()->route('auth.sign-in-page');
        } else {
            // \Log::info('Decoded Token:', (array) $result);

            $request->headers->set('email', $result->email);

            // $request->attributes->set('email', $result->email);
            // $request->attributes->set('id', $result->id);
            return $next($request);
        }
    }
}
