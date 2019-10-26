<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    /**
     * @var \Illuminate\Auth\AuthManager
     */
    protected $authManager;
    /**
     * @var \Illuminate\Auth\Passwords\PasswordBrokerManager
     */
    protected $passwordBrokerManager;
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * AuthService constructor.
     *
     * @param \Illuminate\Auth\AuthManager                     $authManager
     * @param \Illuminate\Auth\Passwords\PasswordBrokerManager $passwordBrokerManager
     * @param \App\Models\User                            $user
     */
    public function __construct(AuthManager $authManager, PasswordBrokerManager $passwordBrokerManager, User $user)
    {
        $this->authManager           = $authManager;
        $this->passwordBrokerManager = $passwordBrokerManager;
        $this->user                  = $user;
    }

    /**
     * @param $credentials
     *
     * @return bool
     */
    public function authenticate($credentials)
    {
        return $this->authManager
            ->guard()
            ->attempt($credentials);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function register(Request $request)
    {
        return $this->user->create(
            $request->only('name', 'email', 'password')
        );
    }

    /**
     * @param \Illuminate\Http\Request   $request
     * @param \App\Models\User|null $user
     *
     * @return \Laravel\Passport\PersonalAccessTokenResult
     */
    public function generateAccessToken(Request $request, User $user = null)
    {
        return $request->user() ? $request->user()->createToken('Personal Access Token') : $user->createToken('Personal Access Token');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function sendForgotPasswordResetLink(Request $request)
    {
        $response = $this->passwordBrokerManager->sendResetLink([
            $request->only('email'),
        ]);

        return $response === Password::RESET_LINK_SENT;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function resetPassword(Request $request)
    {
        $response = $this->passwordBrokerManager->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->password = $password;
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $response === Password::PASSWORD_RESET;

    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function logout(Request $request)
    {
        return $request->user()->token()->revoke();
    }

}
