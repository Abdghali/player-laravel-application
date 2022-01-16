<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
        return [
            'name'               => 'required|min:3|max:255|regex:/^([^0-9]*)$/',
            'email'              => 'nullable|max:255|unique:users,email|email|regex:/^([a-zA-Z\d\._]+)@([a-zA-Z\d-]+)\.([a-zA-Z]{2,8})(\.[a-zA-Z]{2,8})?$/',
            'player_type_id'     => 'required|exists:player_types,id',
            'city_id'            => 'required|exists:cities,id',
            'image'              => 'nullable',
            'device_name'        => 'required'
        ];
    }
}
