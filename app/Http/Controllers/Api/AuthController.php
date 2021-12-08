<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Transformers\Logintransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if ($token = Auth::attempt($request->only('email', 'password'))) {

            $categories = fractal($token, new Logintransformer());

            return response()->json(['code' => 200, 'message' => '', 'item' => $categories], 200);

        }
        return response()->json(['code' => 422, 'message' => 'Invalid email or password', 'item' => ''], 422);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json(['code' => 200, 'message' => 'Successfully logged out', 'item' => ''], 200);
    }

}
