<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            // Jika ya, lanjutkan request
            return $next($request);
        }

        // Jika tidak, redirect ke halaman utama atau halaman login dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki hak akses Admin.');
    }
}
