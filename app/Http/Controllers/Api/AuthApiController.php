<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Thông tin đăng nhập không chính xác.'], 422);
        }

        $plainTextToken = Str::random(64);

        DB::table('personal_access_tokens')->insert([
            'tokenable_type' => User::class,
            'tokenable_id' => $user->id,
            'name' => 'api',
            'token' => hash('sha256', $plainTextToken),
            'abilities' => json_encode(['*']),
            'expires_at' => now()->addYear(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $plainTextToken,
            'user' => $user->only(['id', 'name', 'email', 'role']),
        ]);
    }

    public function logout(Request $request)
    {
        $plainTextToken = $request->bearerToken();
        DB::table('personal_access_tokens')->where('token', hash('sha256', (string) $plainTextToken))->delete();

        return response()->json(['message' => 'Đã đăng xuất khỏi API.']);
    }
}
