<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $headers = [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => env('SECURITY_X_FRAME_OPTIONS', 'SAMEORIGIN'),
            'Referrer-Policy' => env('SECURITY_REFERRER_POLICY', 'strict-origin-when-cross-origin'),
            'Permissions-Policy' => env('SECURITY_PERMISSIONS_POLICY', 'camera=(), microphone=(), geolocation=()'),
            'X-Permitted-Cross-Domain-Policies' => 'none',
        ];

        foreach ($headers as $name => $value) {
            if (! empty($value)) {
                $response->headers->set($name, $value);
            }
        }

        if ($request->isSecure() && filter_var(env('SECURITY_HSTS_ENABLED', true), FILTER_VALIDATE_BOOL)) {
            $response->headers->set('Strict-Transport-Security', env('SECURITY_HSTS_VALUE', 'max-age=31536000; includeSubDomains'));
        }

        return $response;
    }
}
