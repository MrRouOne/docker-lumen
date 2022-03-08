<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
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
        if (Auth::user()->id != $request->route('id')) {
            throw new HttpResponseException(response()->json([
                "error" => "Вы не владелец учётной записи!"
            ]));
        }
        return $next($request);
    }
}
