<?php

namespace App\Http\Requests;

use App\Http\Requests\Abstracts\AbstractFormRequest;
use Carbon\Carbon;


/**
 * @property-read  $currency_code
 * @property-read  $date
 */
class RateRequest extends AbstractFormRequest
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
            'currency_code' => 'string|required',
            'date'          => 'string|date|required',
        ];
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currency_code;
    }

    /**
     * @return string
     */
    public function getFromDate(): string
    {
        return Carbon::parse($this->date)
            ->subDay()
            ->format('d/m/Y');
    }

    /**
     * @return string
     */
    public function getToDate(): string
    {
        return Carbon::parse($this->date)
            ->format('d/m/Y');
    }
}
