<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\ApiLoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Login the user
     */
    public function login(LoginRequest $request, ApiLoginAction $loginAction): JsonResponse
    {
        $token = $loginAction->execute($request->email, $request->password);

        $params = $token ? ['data' => ['token' => $token]] : ['error' => 'Login details are invalid'];
        $code   = $token ? Response::HTTP_OK : Response::HTTP_UNAUTHORIZED;

        return response()->json($params, $code);
    }
}
