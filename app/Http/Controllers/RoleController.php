<?php

namespace App\Http\Controllers;

use App\Contracts\RoleContract;
use App\Http\Requests\{RoleStore, RoleUpdate};
use App\Http\Resources\Role;
use App\Http\Resources\RoleCollection;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers
 */
class RoleController extends MainController
{

    /**
     * @var \App\Contracts\PermissionContract
     */
    protected $roleContract;

    /**
     * PermissionController constructor.
     *
     * @param \App\Contracts\RoleContract $roleContract
     */
    public function __construct(RoleContract $roleContract)
    {
        $this->roleContract = $roleContract;

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
            new RoleCollection($this->roleContract
                ->withCriteria([
                    new EagerLoad(['permissions', 'users']),
                ])
                ->paginate(request('perPage', 15)))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\RoleStore $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleStore $request)
    {
        return $this->response->success(
            new Role($this->roleContract->store($request->only('name', 'guard_name')))
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
            new Role($this->roleContract
                ->withCriteria([
                    new EagerLoad(['permissions', 'users']),
                ])
                ->show($id))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\RoleUpdate $request
     * @param int                           $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleUpdate $request, $id)
    {
        $this->roleContract->update($request->only('name', 'guard_name'), $id);

        return $this->response->success(
            new Role($this->roleContract->show($id))
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
        $this->roleContract->destroy($id);

        return $this->response->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncPermissions(Request $request, $id)
    {
        $role = $this->roleContract->show($id);

        $role->syncPermissions($request->input('permissions', []));

        return $this->response->noContent();

    }
}
