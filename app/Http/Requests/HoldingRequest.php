<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HoldingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'client_id'     => 'required|exists:clients,id',
            'stock_code'  => 'required|string|max:20',
            'quantity'      => 'required|integer|min:1',
            'buy_price'     => 'required|numeric|min:0',
            'sector'        => 'required|string|max:100',
            'buy_date'      => 'nullable|date',
        ];
    }
}
