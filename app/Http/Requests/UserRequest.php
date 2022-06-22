<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
         'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('users')],
            'password' => 'required|min:8',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::failed($validator->errors() , Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}