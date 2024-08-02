<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\CustomerRegistrationRequest;
use App\Services\Auth\ApiAuthService;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use Illuminate\Http\JsonResponse;

class CustomerAuthController extends Controller
{
    private ApiAuthService $authService;

    public function __construct(ApiAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function createCustomer(CustomerRegistrationRequest $request): JsonResponse
    {
        $response = $this->authService->createCustomer($request->validated());        
        return response()->json($response);

    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->authService->login($request, 'customer');
        return response()->json($response);
    }

    public function sendResetPasswordLink(ForgetPasswordRequest $request)
    {
        $response =  $this->authService->sendResetPasswordLink($request->validated());
        return response()->json($response);
    }
}
