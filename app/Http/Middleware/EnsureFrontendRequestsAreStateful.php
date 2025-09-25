<?php

namespace App\Http\Middleware;

class EnsureFrontendRequestsAreStateful extends \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful
{
    protected function configureSecureCookieSessions(): void
    {
        config([
            'session.http_only' => true,
            'session.secure' => true,
            'session.partitioned' => true,
            'session.same_site' => 'none',
        ]);
    }
}
