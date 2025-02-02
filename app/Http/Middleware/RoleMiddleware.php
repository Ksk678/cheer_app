<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
{
    if ($role === 'player' && !$request->user()->isPlayer()) {
        abort(403, 'Unauthorized');
    }

    if ($role === 'club' && !$request->user()->isClub()) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}
}
