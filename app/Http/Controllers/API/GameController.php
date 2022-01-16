<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Game\GeneralResource;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GeneralResource::collection(
            user()->city->games()->with(['playground', 'admin'])
                ->whereDate('start', '>=', now())
                ->orderByDesc('type')
                ->orderBy('updated_at')
                ->get()
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function next()
    {
        return GeneralResource::collection(
            user()->games()->with(['playground', 'admin'])
                ->whereDate('start', '>=', now())
                ->where('type', Game::RUNNNIG)
                ->orderBy('start')
                ->get()
        );
    }

    // 2021-05-23T11:26:48.000000Z
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function last()
    {
        return GeneralResource::collection(
            user()->games()->with(['playground', 'admin'])
                ->whereDate('start', '<', now())
                ->where('type', Game::RUNNNIG)
                ->get()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  Game $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return new GeneralResource($game);
    }


    /**
     * Join match.
     *
     * @param Game $game
     * @return \Illuminate\Http\Response
     */
    public function join(Game $game)
    {
        return user()->games()->syncWithoutDetaching($game);

        return response()->json([
            'message'   => __('You have joined a match!')
        ]);
    }

    /**
     * Get out from match.
     * 
     * @param Game $game
     * @return \Illuminate\Http\Response
     */
    public function out(Game $game)
    {
        user()->games()->detach($game->id);


        return response()->json([
            'message'   => __('You have unjoin a match!')
        ]);
    }
}
