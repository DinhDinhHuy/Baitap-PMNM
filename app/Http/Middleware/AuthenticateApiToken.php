<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $plainTextToken = $request->bearerToken();

        if (! $plainTextToken) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $token = \DB::table('personal_access_tokens')
            ->where('token', hash('sha256', $plainTextToken))
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->first();

        if (! $token || $token->tokenable_type !== User::class) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $user = User::find($token->tokenable_id);

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        \DB::table('personal_access_tokens')->where('id', $token->id)->update(['last_used_at' => now()]);
        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
