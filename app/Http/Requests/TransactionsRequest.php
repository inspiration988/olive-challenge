<?php

namespace App\Http\Requests;

use App\Models\Transactions;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class TransactionsRequest extends FormRequest
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
            'amount' => 'required|integer',
            'type' => ['required',Rule::in([Transactions::TYPE_DEPOSIT , Transactions::TYPE_WITHDRAW])]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::failed($validator->errors() , Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}