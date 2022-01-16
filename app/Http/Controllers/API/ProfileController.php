<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\User\GeneralResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateProfileRequest $request)
    {
        if ($request->method()  == Request::METHOD_GET) {
            return new GeneralResource(user());
        }

        if (request()->has('image')) {

            user()->clearMediaCollection();

            user()->addMediaFromBase64(request()->image)
                ->toMediaCollection();
        }

        user()->update($request->validated());

        return new GeneralResource(user());;
    }
}
