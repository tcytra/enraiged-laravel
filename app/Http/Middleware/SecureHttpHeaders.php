<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Symfony\Component\HttpFoundation\Response;

final class SecureHttpHeaders
{
    /**
     *  Handle the given request and get the response.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Closure  $next
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!app()->environment('local')) {
            foreach ((array) config('headers.remove') as $header) {
                header_remove($header);

                $response->headers->remove(
                    key: $header,
                );
            }

            $response->headers->set(
                key: 'Expect-CT',
                values: strval(config('headers.certificate-transparency')),
            );

            $response->headers->set(
                key: 'Strict-Transport-Security',
                values: strval(config('headers.strict-transport-security')),
            );

            $response->headers->set(
                key: 'X-Frame-Options',
                values: strval(config('headers.x-frame-options')),
            );

            $response->headers->set(
                key: 'Referrer-Policy',
                values: strval(config('headers.referrer-policy')),
            );

            $response->headers->set(
                key: 'X-XSS-Protection',
                values: strval(config('headers.x-xss-protection')),
            );

            $response->headers->set(
                key: 'X-Permitted-Cross-Domain-Policies',
                values: strval(config('headers.x-permitted-cross-domain-policies')),
            );

            $response->headers->set(
                key: 'X-Content-Type-Options',
                values: strval(config('headers.x-content-type-options')),
            );

            $response->headers->set(
                key: 'Content-Security-Policy',
                values: strval(config('headers.content-security-policy')),
            );

            $response->headers->set(
                key: 'Permissions-Policy',
                values: strval(config('headers.permissions-policy')),
            );

        }

        return $response;
    }
}
