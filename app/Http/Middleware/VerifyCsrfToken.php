<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'ajax/*',
        'api/v1/*',
        'api/v2/*',
        'wallet/create/*',
        'wallet/update/*',
        '/exchange',
        '/payment/result',
        'get-banners-test',
    ];
}
