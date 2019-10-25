<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

/**
 * Class AuthTest
 * @package Tests\Feature
 */
class AuthTest extends TestCase
{
    /**
     *
     */
    public function test_it_requires_an_email()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonStructure([
                'data' => ['errors'],
            ]);
    }

    /**
     *
     */
    public function test_it_requires_an_password()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonStructure([
                'data' => ['errors'],
            ]);
    }

    /**
     *
     */
    public function test_it_returns_a_validation_if_credentials_dont_match()
    {
        $this->json('POST', 'api/auth/login',
            [
                'email'    => 'wrong@phpuzem.com',
                'password' => 12345678,
            ])
            ->assertStatus(422);
    }

    /**
     *
     */
    public function test_it_returns_a_validation_if_credentials_do_match()
    {
        Artisan::call('passport:install');
        $user = factory(User::class)->create([
            'password' => 'secret',
        ]);
        $this->json('POST', 'api/auth/login',
            [
                'email'    => $user->email,
                'password' => 'secret',
            ])->assertJsonFragment([
            'email' => $user->email,
        ]);;
    }

    /**
     *
     */
    public function test_it_if_user_isnt_authenticated()
    {
        $this->json('GET', 'api/auth/me')
            ->assertStatus(401);
    }

    /**
     *
     */
    public function test_it_returns_user_detail()
    {
        Artisan::call('passport:install');
        Passport::actingAs(
            $user = factory(User::class)->create()
        );

        $this->json('GET', 'api/auth/me')
            ->assertJsonFragment([
                'email' => $user->email,
            ]);
    }

    /**
     *
     */
    public function test_it_reqister_user()
    {
        Artisan::call('passport:install');

        $this->json('POST', 'api/auth/register', [
            'name'     => 'Halil Coşdu',
            'email'    => 'register@phpuzem.com',
            'password' => 12345678,
        ])
            ->assertStatus(200);
    }


}
