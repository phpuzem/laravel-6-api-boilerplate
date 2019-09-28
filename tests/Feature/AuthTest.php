<?php

namespace Tests\Feature;

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
        $this->json('POST', 'api/auth/login',
            [
                'email'    => 'destek@phpuzem.com',
                'password' => 12345678,
            ])
            ->assertStatus(200);
    }
}
