<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdatePaymentRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'method_id' => ['required', 'integer',]
        ];
    }
}
