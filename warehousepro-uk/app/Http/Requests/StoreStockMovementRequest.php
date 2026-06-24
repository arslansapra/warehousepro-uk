<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockMovementRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:stock_in,stock_out,adjustment'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reason' => ['nullable', 'max:500']

        ];
    }
}
