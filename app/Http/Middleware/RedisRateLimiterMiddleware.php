<?php


namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;


class RedisRateLimiterMiddleware extends ThrottleRequestsWithRedis
{
    protected function resolveRequestSignature($request)
    {
        return sha1($request->getHost() . '|' . $request->ip());
    }
}