<?php

namespace Tests\Feature;

use App\Http\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Class RolesTest
 * @package Tests\Feature
 */
class RolesTest extends TestCase
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
    public function test_it_get_all_roles()
    {
        $this->json('GET', 'api/roles')
            ->assertJsonFragment([
                'status' => 'success',
            ]);
    }

    /**
     *
     */
    public function test_it_storing_role()
    {
        $this->json('POST', 'api/roles', [
            'name'       => 'Test Role',
            'guard_name' => 'web',
        ])
            ->assertJsonFragment([
                'guard_name' => 'web',
            ]);
    }

    /**
     *
     */
    public function test_it_showing_role()
    {
        $role = factory(Role::class)->create();

        $this->json('GET', 'api/roles/' . $role->id . '')
            ->assertJsonFragment([
                'name' => $role->name,
            ]);
    }

    /**
     *
     */
    public function test_it_updating_role()
    {
        $role = factory(Role::class)->create();

        $this->json('PATCH', 'api/roles/' . $role->id . '', [
            'name'       => 'Updated Role',
            'guard_name' => 'web',
        ])
            ->assertJsonFragment([
                'name' => 'Updated Role',
            ]);
    }

    /**
     *
     */
    public function test_it_destroying_role()
    {
        $role = factory(Role::class)->create();

        $this->json('DELETE', 'api/roles/' . $role->id . '')
            ->assertStatus(204);
    }

    ################################################################################
    ############################ Relation Tests ####################################
    ################################################################################

    /**
     *
     */
    public function test_it_role_syncing_with_permissions()
    {
        $permissions = factory(Permission::class, 5)->create([
            'guard_name' => 'web',
        ]);

        $role = factory(Role::class)->create([
            'guard_name' => 'web',
        ]);

        $this->json('POST', 'api/roles/' . $role->id . '/sync-permissions', [
            'roles' => $permissions->pluck('id'),
        ])
            ->assertStatus(204);;
    }
}
