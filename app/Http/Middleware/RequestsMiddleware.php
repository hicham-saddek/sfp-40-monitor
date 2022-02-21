<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function response;

class RequestsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->server->has('REDIRECT_REDIRECT_REQUEST_METHOD')) {
            $request->setMethod($request->server('REDIRECT_REDIRECT_REQUEST_METHOD'));
        }
        return $next($request);
    }
}
