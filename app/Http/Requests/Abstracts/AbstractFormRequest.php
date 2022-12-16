<?php

namespace App\Http\Requests\Abstracts;

use App\Http\Responses\Abstracts\AbstractResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class AbstractFormRequest
 */
class AbstractFormRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->error($validator->errors(), AbstractResponse::ERROR_VALIDATION));
    }
}
