<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerType\GeneralResource;
use App\Models\PlayerType;

class PlayerTypeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return GeneralResource::collection(
            PlayerType::orderBy('updated_at')->get()

        );
    }
}
