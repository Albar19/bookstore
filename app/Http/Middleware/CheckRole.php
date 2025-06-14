<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah pengguna sudah login DAN perannya sesuai dengan yang diizinkan
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika tidak, tendang dengan halaman error 403 (Forbidden)
            abort(403, 'ANDA TIDAK PUNYA AKSES KE HALAMAN INI.');
        }

        // Jika sesuai, izinkan masuk ke halaman berikutnya
        return $next($request);
    }
}
