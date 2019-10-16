<?php

namespace App\Http\Controllers;

use App\Contracts\CharacterContract;
use App\Http\Requests\CharacterStore;
use App\Http\Requests\CharacterUpdate;
use App\Http\Resources\Character;
use App\Http\Resources\CharacterCollection;
use App\Repositories\Eloquent\Criteria\EagerLoad;

/**
 * Class CharacterController
 * @package App\Http\Controllers
 */
class CharacterController extends MainController
{

    /**
     * @var \App\Contracts\CharacterContract
     */
    protected $characterContract;

    /**
     * PermissionController constructor.
     *
     * @param \App\Contracts\CharacterContract $characterContract
     */
    public function __construct(CharacterContract $characterContract)
    {
        $this->characterContract = $characterContract;

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
            new CharacterCollection($this->characterContract
                ->withCriteria([
                    new EagerLoad(['job']),
                ])
                ->paginate(request('perPage', 15)))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CharacterStore $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CharacterStore $request)
    {
        if ($request->user()->characters->count() > 3) {
            return $this->response->fail([
                'errors' => 'You can have only 4 characters.',
            ]);
        }

        return $this->response->success(
            new Character($this->characterContract->store($request->only('user_id', 'job_id', 'appearance_id',
                'name',
                'gender')))
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
            new Character($this->characterContract
                ->withCriteria([
                    new EagerLoad(['job']),
                ])
                ->show($id))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CharacterUpdate $request
     * @param int                                $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CharacterUpdate $request, $id)
    {
        $this->characterContract->update($request->only('user_id', 'job_id', 'appearance_id', 'name', 'gender'), $id);

        return $this->response->success(
            new Character($this->characterContract->show($id))
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
        $this->characterContract->destroy($id);

        return $this->response->noContent();
    }
}
