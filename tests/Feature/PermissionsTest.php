<?php

namespace Tests\Feature;

use App\Http\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

/**
 * Class PermissionsTest
 * @package Tests\Feature
 */
class PermissionsTest extends TestCase
{
    /**
     * @var mixed
     */
    protected $user;

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('passport:install', ['--force' => true]);

        Passport::actingAs(
            $this->user = factory(User::class)->create()
        );

    }

    /**
     *
     */
    public function test_it_get_all_permissions()
    {
        $this->json('GET', 'api/permissions')
            ->assertJsonFragment([
                'status' => 'success',
            ]);
    }

    /**
     *
     */
    public function test_it_storing_permission()
    {
        $this->json('POST', 'api/permissions', [
            'name'       => 'Test Permission',
            'guard_name' => 'web',
        ])
            ->assertStatus(200);
    }
}
