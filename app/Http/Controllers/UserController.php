<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\{SyncRolesAndPermissions, UserStore, UserUpdate};
use App\Http\Resources\Auth\User;
use App\Http\Resources\Auth\UserCollection;
use App\Repositories\Eloquent\Criteria\EagerLoad;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends MainController
{

    /**
     * @var \App\Contracts\UserContract
     */
    protected $userContract;

    /**
     * PermissionController constructor.
     *
     * @param \App\Contracts\UserContract $userContract
     */
    public function __construct(UserContract $userContract)
    {
        $this->userContract = $userContract;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response->success(
            new UserCollection($this->userContract
                ->withCriteria([
                    new EagerLoad(['roles', 'permissions']),
                ])
                ->paginate(request('perPage', 15)))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserStore $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStore $request)
    {
        return $this->response->success(
            new User($this->userContract->store($request->only('name', 'email', 'password')))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->response->success(
            new User($this->userContract
                ->withCriteria([
                    new EagerLoad(['roles', 'permissions']),
                ])
                ->show($id))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UserUpdate $request
     * @param int                           $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdate $request, $id)
    {
        if ($request->filled('password')) {
            $this->userContract->update($request->only('name', 'email', 'password'), $id);

        } else {
            $this->userContract->update($request->only('name', 'email'), $id);
        }

        return $this->response->success(
            new User($this->userContract->show($id))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->userContract->destroy($id);

        return $this->response->noContent();
    }

    /**
     * @param \App\Http\Requests\SyncRolesAndPermissions $request
     * @param                                            $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncRolesAndPermissions(SyncRolesAndPermissions $request, $id)
    {
        $user = $this->userContract->show($id);
        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));

        return $this->response->noContent();
    }
}
