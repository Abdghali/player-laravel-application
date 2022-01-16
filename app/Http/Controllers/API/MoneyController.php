<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RestoreFee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoneyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        if ($request->method() == Request::METHOD_GET) {
            return response()->json([
                'has_money_request'  => user()->restoreFee ? true : false
            ]);
        }

        user()->restoreFee()->create();

        return response()->json([
            'message'    => __('Your money back request successfully sent!')
        ], Response::HTTP_CREATED);
    }
}
