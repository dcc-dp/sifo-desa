<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckPengajuanAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if pengajuan session exists
        if (!Session::has('pengajuan_nik')) {
            return redirect()->route('pengajuan.login-form')
                ->with('warning', 'Silakan login terlebih dahulu untuk melakukan pengajuan surat');
        }

        return $next($request);
    }
}
