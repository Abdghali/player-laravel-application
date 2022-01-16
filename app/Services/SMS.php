<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMS
{
    public static function  send($number, $message)
    {

        return Http::get(config('sms.service_url'), [

            'send_sms' => '',

            'username' => config('sms.username'),

            'password' => config('sms.password'),

            'sender'  => config('sms.sender'),

            'numbers'  => '966' . $number,

            'message' => $message,

        ]);
    }
}
