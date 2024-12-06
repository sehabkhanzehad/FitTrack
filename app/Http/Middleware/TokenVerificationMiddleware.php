<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('signInToken');
        if ($token == null) {
            return redirect()->route('auth.sign-in-page');
        }
        // dd($token);
        $result = JWTToken::decodeToken($token);
        if ($result == 'unauthorized') {
            return redirect()->route('auth.sign-in-page');
        } else {
            // dd($result);
            $request->headers->set('email', $result->email);
            $request->headers->set('id', $result->id);
            return $next($request);
        }
    }
}
