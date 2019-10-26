<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\MainController;
use App\Http\Requests\Auth\ForgotPassword;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\Register;
use App\Http\Requests\Auth\ResetPassword;
use App\Http\Resources\Auth\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends MainController
{
    /**
     * @param \App\Http\Requests\Auth\Login $request
     * @param \App\Services\AuthService     $authService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Login $request, AuthService $authService)
    {
        $credentials = $request->only('email', 'password');

        if (! $authService->authenticate($credentials)) {
            return $this->response->fail([
                'errors' => [
                    'failed' => 'Invalid credentials.',
                ],
            ]);
        }

        $token = $authService->generateAccessToken($request);

        return $this->response->success((new User($request->user()))
            ->additional([
                'meta' => [
                    'accessToken' => $token->accessToken,
                    'expiresIn'   => $token->token->expires_at,
                ],
            ])
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return $this->response->success(new User($request->user()));
    }

    /**
     * @param \App\Http\Requests\Auth\Register $request
     * @param \App\Services\AuthService        $authService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Register $request, AuthService $authService)
    {
        $user = $authService->register($request);

        $token = $authService->generateAccessToken($request, $user);

        return $this->response->success((new User($user))
            ->additional([
                'meta' => [
                    'accessToken' => $token->accessToken,
                    'expiresIn'   => $token->token->expires_at,
                ],
            ])
        );
    }

    /**
     * @param \App\Http\Requests\Auth\ForgotPassword $request
     * @param \App\Services\AuthService              $authService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendForgotPasswordResetLink(ForgotPassword $request, AuthService $authService)
    {
        if (! $authService->sendForgotPasswordResetLink($request)) {
            return $this->response->fail();
        }

        return $this->response->success([
            'message' => $request->input('email') . ' password reset link sent!',
        ]);
    }

    /**
     * @param \App\Http\Requests\Auth\ResetPassword $request
     * @param \App\Services\AuthService             $authService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPassword $request, AuthService $authService)
    {
        if (! $authService->resetPassword($request)) {
            return $this->response->fail();
        }

        return $this->response->success([
            'message' => $request->input('email') . ' password changed!',
        ]);
    }

    /**
     * @param \Illuminate\Http\Request  $request
     * @param \App\Services\AuthService $authService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout($request);

        return $this->response->success();
    }
}
