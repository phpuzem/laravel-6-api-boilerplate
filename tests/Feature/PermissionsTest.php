<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
            ->assertJsonFragment([
                'guard_name' => 'web',
            ]);
    }

    /**
     *
     */
    public function test_it_showing_permission()
    {
        $permission = factory(Permission::class)->create();

        $this->json('GET', 'api/permissions/' . $permission->id . '')
            ->assertJsonFragment([
                'name' => $permission->name,
            ]);
    }

    /**
     *
     */
    public function test_it_updating_permission()
    {
        $permission = factory(Permission::class)->create();

        $this->json('PATCH', 'api/permissions/' . $permission->id . '', [
            'name'       => 'Updated Permission',
            'guard_name' => 'web',
        ])
            ->assertJsonFragment([
                'name' => 'Updated Permission',
            ]);
    }

    /**
     *
     */
    public function test_it_destroying_permission()
    {
        $permission = factory(Permission::class)->create();

        $this->json('DELETE', 'api/permissions/' . $permission->id . '')
            ->assertStatus(204);
    }

    ################################################################################
    ############################ Relation Tests ####################################
    ################################################################################

    /**
     *
     */
    public function test_it_permission_syncing_with_roles()
    {
        $roles = factory(Role::class, 5)->create([
            'guard_name' => 'web',
        ]);

        $permission = factory(Permission::class)->create([
            'guard_name' => 'web',
        ]);

        $this->json('POST', 'api/permissions/' . $permission->id . '/sync-roles', [
            'roles' => $roles->pluck('id'),
        ])
            ->assertStatus(204);;
    }

}
