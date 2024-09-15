<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roles = array_map('intval',$roles);
            // Check if the user's role is in the allowed roles
            if (!in_array($user->id_role, $roles)) {
                abort(403, 'Anda Tidak Memiliki Akses Ke Halaman Ini');
            }
        } else {
            abort(403, 'Anda Tidak Memiliki Akses Ke Halaman Ini');
        }

        return $next($request);
    }
}
