<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Permission extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'guard_name' => $this->guard_name,
            'roles'      => new RoleCollection($this->whenLoaded('roles')),
            'users'      => $this->users,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
