<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGioHanhChinh
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $gioHienTai = now();
        $gioBatDau = $gioHienTai->copy()->setTime(8, 30, 0);
        $gioKetThuc = $gioHienTai->copy()->setTime(17, 30, 0);

        if ($gioHienTai->lt($gioBatDau) || $gioHienTai->gt($gioKetThuc)) {
            return response()->json(['message' => 'Outside working hours'], 403);
        }

        return $next($request);
    }
}
