<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplicationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'content'   => 'required|min:3'
        ]);

        user()->applications()->create([
            'content'   => request()->content
        ]);

        return response()->json([
            'message'   => __('Your application successfully sent!')
        ] , Response::HTTP_CREATED);
    }
}
