<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->is_admin) {
            throw new HttpResponseException(response()->json([
                "error" => "Вы не администратор!"
            ]));
        }
        return $next($request);
    }
}
