<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Resources\User\TokenCreationResource;
use App\Models\Number;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function __invoke(Number $number, RegistrationRequest $request)
    {

        if ($number->isUsed()) {
            throw ValidationException::withMessages([
                'number' => [__('The number is used before.')],
            ]);
        }


        if (!$number->isVerified()) {
            throw ValidationException::withMessages([
                'number' => [__('The number is not verified.')],
            ]);
        }

        $number->markAsNotVerified();

        return new TokenCreationResource(
            tap(
                User::create(
                    Arr::add(
                        $request->validated(),
                        'number',
                        $number->content
                    )
                ),
                function ($user) {
                    if (request()->has('image')) {
                        $user->addMediaFromBase64(request()->image)
                            ->toMediaCollection();

                        $user->image = $user->image();
                    }
                }
            )
        );
    }
}
