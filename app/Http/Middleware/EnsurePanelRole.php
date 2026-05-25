<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePanelRole
{
    public function handle(Request $request, Closure $next, string ...$allowedRoles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401);
        }

        if (in_array((string) $user->role?->name, ['administrador', 'admin'], true)) {
            return $next($request);
        }

        if (empty($allowedRoles)) {
            return $next($request);
        }

        if (! in_array((string) $user->role?->name, $allowedRoles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
