<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Cek apakah user login dan punya role admin
        if (Auth::check() && Auth::user()->user_group === 'admin') {
            return $next($request);
        }

        // Kalau bukan admin, redirect ke dashboard biasa
        return redirect()->route('dashboard')->withErrors(['access_denied' => 'Anda tidak memiliki akses admin.']);
    }
}
