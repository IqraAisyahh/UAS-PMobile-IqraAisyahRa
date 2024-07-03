<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole('siswa')) {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'Akses ditolak. Hanya siswa yang dapat mengakses endpoint ini.'
        ], 403);
    }
}
