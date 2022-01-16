<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if (request()->method() == Request::METHOD_GET) {
            return [];
        }
        return [
            'name'               => 'required|min:3|max:255|regex:/^([^0-9]*)$/',
            'email'              => 'nullable|max:255|email|regex:/^([a-zA-Z\d\._]+)@([a-zA-Z\d-]+)\.([a-zA-Z]{2,8})(\.[a-zA-Z]{2,8})?$/|unique:users,email,'.user()->id,
            'player_type_id'     => 'required|exists:player_types,id',
            'city_id'            => 'required|exists:cities,id',
            'image'              => 'nullable',
        ];
    }
}
