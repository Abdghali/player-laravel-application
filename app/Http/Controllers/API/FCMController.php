<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FCMController extends Controller
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
            'token' => 'required'
        ]);


        user()->forceFill([
            'token' => $request->token
        ])->save();

        return response('', Response::HTTP_NO_CONTENT);
    }
}
