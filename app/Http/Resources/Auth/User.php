<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\CharacterCollection;
use App\Http\Resources\Race;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'id'                => $this->id,
            'race_id'           => $this->race_id,
            'race'              => $this->whenLoaded('race', new Race($this->race)),
            'characters'        => $this->whenLoaded('characters', new CharacterCollection($this->characters)),
            'username'          => $this->username,
            'email'             => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
