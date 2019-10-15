<?php

namespace App\Http\Resources;

use App\Http\Resources\Auth\UserCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class Race extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'users'       => new UserCollection($this->whenLoaded('users')),
            'jobs'        => new JobCollection($this->whenLoaded('jobs')),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
