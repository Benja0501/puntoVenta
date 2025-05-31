<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'provider_id' => 'required|exists:providers,id',
            'tax' => 'required|numeric|min:0',
            'picture' => 'nullable|file|image',
            'product_id.*' => 'required|integer|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
            'price.*' => 'required|numeric|min:0',
        ];
    }
}
