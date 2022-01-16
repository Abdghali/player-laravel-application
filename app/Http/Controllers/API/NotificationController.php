<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
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
                'notifications_settings'  => user()->notifications_settings ? true : false
            ]);
        }

        $request->validate([
            'notifications_settings' => 'required|min:0|max:1'
        ]);

        user()->update([
            'notifications_settings' => $request->notifications_settings
        ]);

        return response('', Response::HTTP_NO_CONTENT);
    }
}
