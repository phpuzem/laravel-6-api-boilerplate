<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Class UsersTest
 * @package Tests\Feature
 */
class UsersTest extends TestCase
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
    public function test_it_get_all_users()
    {
        $this->json('GET', 'api/users')
            ->assertJsonFragment([
                'status' => 'success',
            ]);
    }

    /**
     *
     */
    public function test_it_storing_user()
    {
        $this->json('POST', 'api/users', [
            'name'                  => 'Halil Coşdu',
            'email'                 => 'destek@phpuzem.com',
            'password'              => 12345678,
            'password_confirmation' => 12345678,
        ])
            ->assertJsonFragment([
                'email' => 'destek@phpuzem.com',
            ]);
    }

    /**
     *
     */
    public function test_it_showing_user()
    {
        $this->json('GET', 'api/users/' . $this->user->id . '')
            ->assertJsonFragment([
                'name' => $this->user->name,
            ]);
    }

    /**
     *
     */
    public function test_it_updating_user()
    {
        $this->json('PATCH', 'api/users/' . $this->user->id . '', [
            'name'                  => 'Halil Coşdu',
            'email'                 => 'updated@phpuzem.com',
            'password'              => 12345678,
            'password_confirmation' => 12345678,
        ])
            ->assertJsonFragment([
                'email' => 'updated@phpuzem.com',
            ]);
    }

    /**
     *
     */
    public function test_it_destroying_user()
    {

        $this->json('DELETE', 'api/users/' . $this->user->id . '')
            ->assertStatus(204);
    }

    ################################################################################
    ############################ Relation Tests ####################################
    ################################################################################

    /**
     *
     */
    public function test_it_user_syncing_with_roles_and_permissions()
    {
        $roles = factory(Role::class, 5)->create([
            'guard_name' => 'web',
        ]);

        $permissions = factory(Permission::class, 5)->create([
            'guard_name' => 'web',
        ]);

        $this->json('POST', 'api/users/' . $this->user->id . '/sync-roles-and-permissions', [
            'roles'       => $roles->pluck('id'),
            'permissions' => $permissions->pluck('id'),
        ])
            ->assertStatus(204);
    }

}
