<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequestApi extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Unauthorized',
            'statusCode' => 403
        ], 403));
    }
}
