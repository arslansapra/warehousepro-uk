<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
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
            
        'company_name' => [
            'required',
            'max:255'
        ],

        'contact_person' => [
            'required',
            'max:255'
        ],

        'email' => [
            'required',
            'email',
            Rule::unique('suppliers')
                ->ignore($this->supplier)
        ],

        'phone' => [
            'required',
            'max:20'
        ],

        'address' => [
            'required'
        ],
        
        'is_active' => [
            'required',
            'boolean'
        ]

        ];
    }
}
