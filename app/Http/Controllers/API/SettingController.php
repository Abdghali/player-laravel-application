<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'data'  => [
                'twitter'           =>  Setting::twitter(),

                'whatsapp_number'   =>  Setting::whatsapp(),

                'terms'             =>  Setting::terms(),

                'about_us'           =>  Setting::aboutUs()
            ]
        ]);
    }
}
