<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
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
        Vite::useCspNonce();

        $response = $next($request);

        if (!app()->environment('local')) {
            foreach ((array) config('enraiged.headers.remove') as $header) {
                header_remove($header);

                $response->headers->remove(
                    key: $header,
                );
            }

            $response->headers->set(
                key: 'Expect-CT',
                values: strval(config('enraiged.headers.certificate-transparency')),
            );

            $response->headers->set(
                key: 'Strict-Transport-Security',
                values: strval(config('enraiged.headers.strict-transport-security')),
            );

            $response->headers->set(
                key: 'X-Frame-Options',
                values: strval(config('enraiged.headers.x-frame-options')),
            );

            $response->headers->set(
                key: 'Referrer-Policy',
                values: strval(config('enraiged.headers.referrer-policy')),
            );

            $response->headers->set(
                key: 'X-XSS-Protection',
                values: strval(config('enraiged.headers.x-xss-protection')),
            );

            $response->headers->set(
                key: 'X-Permitted-Cross-Domain-Policies',
                values: strval(config('enraiged.headers.x-permitted-cross-domain-policies')),
            );

            $response->headers->set(
                key: 'X-Content-Type-Options',
                values: strval(config('enraiged.headers.x-content-type-options')),
            );

            $response->headers->set(
                key: 'Content-Security-Policy',
                values: strval(
                    __(config('enraiged.headers.content-security-policy'), ['nonce' => Vite::cspNonce()])
                ),
            );

            $response->headers->set(
                key: 'Permissions-Policy',
                values: strval(config('enraiged.headers.permissions-policy')),
            );

        }

        return $response;
    }
}
