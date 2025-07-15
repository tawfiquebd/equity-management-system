<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cacheExpire = auth('api')->factory()->getTTL() * 60;
        Cache::put('jwt_token', $token, $cacheExpire);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $cacheExpire
        ]);
    }

    public function logout()
    {
        auth()->logout();

        Cache::forget('jwt_token');

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $newToken = auth()->refresh();

        Cache::put('jwt_token', $newToken, auth()->factory()->getTTL() * 60);

        return $this->respondWithToken($newToken);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function isAuthenticated()
    {
        if (!Cache::has('jwt_token')) {
            return response()->json([
                'error' => 'Unauthorized - token missing'
            ], 401);
        }

        return response()->json(auth()->user());
    }
}
