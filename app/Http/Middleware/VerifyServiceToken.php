<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyServiceToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // autentikasi antar-service pakai shared secret di header,
        // bukan token user (Sanctum) karena yang manggil adalah service lain, bukan user login
        $token = $request->header('X-Service-Token');

        if (! $token || ! hash_equals(config('services.internal_token'), $token)) {
            abort(401, 'Token service tidak valid');
        }

        return $next($request);
    }
}
