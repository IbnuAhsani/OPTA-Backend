<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/login',
        'api/user/pay',
        'api/user/topup',
        'api/user/balance',
        'api/user/register',
        'api/bus-admin/register',
        'api/bus-admin/bus',
        'api/bus-admin/bus/all',
        'api/bus-admin/bus/add',
        'api/bus-admin/bus/delete',
        'api/bus-admin/bus/update',
    ];
}
