<?php

namespace App\Http\Resources\Game;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\GeneralResource as UserResource;

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
            'fees'              => $this->fees,
            'date'              => Carbon::parse($this->start)->format('Y-m-d'),
            'time'              => Carbon::parse($this->start)->format('H:i'),
            'city_name'         => user()->city->name,
            'original_time'     => $this->start,
            'playground_name'   => $this->playground->name,
            'playground_id'     => $this->playground->id,
            'description'       => $this->description,
            'type'              => $this->type,
            'organizer'         => $this->admin->name,
            'max_players'       => $this->max_players,
            'number_of_players' => $this->users()->count(),
            'location'          => $this->when($this->playground->lng && $this->playground->lat, ['lng' => $this->playground->lng, 'lat' => $this->playground->lat]),
            'players'           => UserResource::collection(
                $this->users
            )
        ];
    }
}
