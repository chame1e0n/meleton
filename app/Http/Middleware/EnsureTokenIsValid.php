<?php

namespace App\Http\Middleware;

use Closure;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken() !== env('TOKEN')) {
            return response(['status' => 'error', 'code' => 403, 'message' => 'Invalid token'], 403);
        }

        return $next($request);
    }
}
