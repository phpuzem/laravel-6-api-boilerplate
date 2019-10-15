<?php

namespace App\Http\Controllers;

use App\Contracts\RaceContract;
use App\Http\Requests\JobStore;
use App\Http\Requests\JobUpdate;
use App\Http\Resources\Race;
use App\Http\Resources\RaceCollection;
use App\Repositories\Eloquent\Criteria\EagerLoad;

/**
 * Class RaceController
 * @package App\Http\Controllers
 */
class RaceController extends MainController
{

    /**
     * @var \App\Contracts\RaceContract
     */
    protected $raceContract;

    /**
     * PermissionController constructor.
     *
     * @param \App\Contracts\RaceContract $raceContract
     */
    public function __construct(RaceContract $raceContract)
    {
        $this->raceContract = $raceContract;

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
            new RaceCollection($this->raceContract
                ->withCriteria([
                    new EagerLoad(['jobs', 'users']),
                ])
                ->paginate(request('perPage', 15)))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\JobStore $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(JobStore $request)
    {
        return $this->response->success(
            new Race($this->raceContract->store($request->only('name', 'description')))
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
            new Race($this->raceContract
                ->withCriteria([
                    new EagerLoad(['jobs', 'users']),
                ])
                ->show($id))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\JobUpdate $request
     * @param int                          $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(JobUpdate $request, $id)
    {
        $this->raceContract->update($request->only('name', 'description'), $id);

        return $this->response->success(
            new Race($this->raceContract->show($id))
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
        $this->raceContract->destroy($id);

        return $this->response->noContent();
    }
}
