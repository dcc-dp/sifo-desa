<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckPengaduanAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if pengaduan session exists
        if (!Session::has('pengaduan_nik')) {
            return redirect()->route('pengaduan.login-form')
                ->with('warning', 'Silakan login terlebih dahulu untuk melakukan pengaduan');
        }

        return $next($request);
    }
}
