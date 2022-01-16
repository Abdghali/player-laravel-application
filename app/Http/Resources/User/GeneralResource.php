<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            // 'token'             => $this->createToken($request->device_name)->plainTextToken,
            'name'              => $this->name,
            'email'             => $this->when($this->email, $this->email),
            'number'            => $this->number,
            'image'             => $this->when($this->image(), $this->image()),
            'player_type_id'    => $this->player_type_id,
            'city_id'           => $this->city_id
        ];
    }
}
