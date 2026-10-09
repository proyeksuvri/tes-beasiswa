<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        abort_unless($user, 401);

        $allowed = collect($roles)->contains(
            fn (string $role) => $user->hasRole($role)
        );

        abort_unless($allowed, 403, 'Anda tidak memiliki hak akses untuk tindakan ini.');

        return $next($request);
    }
}
