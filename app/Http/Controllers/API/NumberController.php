<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Number;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\User\TokenCreationResource;
use App\Http\Resources\Number\GeneralResource as NumberResource;

class NumberController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Number\GeneralRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'content' => 'required|regex:/^[0-9]{9}$/'
        ], [
            'content.regex' => 'يجب أن يكون الرقم مكون من 9 أرقام فقط.'
        ]);

        $user = User::where('number', $request->content)->first();

        if ($user  and  !$user->status) {
            throw ValidationException::withMessages([
                'disabled' => [__('The user is disabled.')],
            ]);
        }

        return new NumberResource(

            tap(Number::firstOrCreate(

                $data

            ))->varificationCodeGenerationWithSmsNotification()
        );
    }


    public function verify(Number $number, Request $request)
    {

        $request->validate([
            'verification_code' =>  ['required', 'digits:6'],
            'device_name'       =>  'required'
        ]);

        if (!($request->verification_code  == $number->verification_code)) {
            throw ValidationException::withMessages([
                'verification_code' => [__('Verification code not correct.')],
            ]);
        }


        $number->markAsVerified();

        $user = User::whereNumber($number->content)->first();


        if (!$user) {
            return response()->json([
                'is_new'   => true,
                'data'  => [
                    'number_id' => $number->id,
                    'number'    => $number->content,
                ]
            ]);
        }

        $number->markAsNotVerified();

        $number->deleteVerificationCode();

        return new TokenCreationResource($user);
    }
}
