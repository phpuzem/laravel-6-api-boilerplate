<?php

namespace App\Http\Controllers;

use App\Contracts\JobContract;
use App\Http\Requests\JobStore;
use App\Http\Requests\JobUpdate;
use App\Http\Resources\Job;
use App\Http\Resources\JobCollection;
use App\Repositories\Eloquent\Criteria\EagerLoad;

/**
 * Class JobController
 * @package App\Http\Controllers
 */
class JobController extends MainController
{

    /**
     * @var \App\Contracts\JobContract
     */
    protected $jobContract;

    /**
     * PermissionController constructor.
     *
     * @param \App\Contracts\JobContract $jobContract
     */
    public function __construct(JobContract $jobContract)
    {
        $this->jobContract = $jobContract;

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
            new JobCollection($this->jobContract
                ->withCriteria([
                    new EagerLoad(['race']),
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
            new Job($this->jobContract->store($request->only('race_id', 'name', 'description')))
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
            new Job($this->jobContract
                ->withCriteria([
                    new EagerLoad(['race']),
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
        $this->jobContract->update($request->only('race_id', 'name', 'description'), $id);

        return $this->response->success(
            new Job($this->jobContract->show($id))
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
        $this->jobContract->destroy($id);

        return $this->response->noContent();
    }
}
