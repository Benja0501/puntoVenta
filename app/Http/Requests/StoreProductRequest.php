<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'image' => 'required|image|file|max:2048|dimensions:min_width=100,min_height=200',
            'name' => 'string|required|unique:products|max:255',
            'code' => 'required|string|unique:products,code|max:50',
            'stock' => 'required|integer|min:0',
            'sell_price' => 'required|numeric|min:0',
            'status' => 'required|in:ACTIVE,INACTIVE',
            'category_id' => 'required|integer|exists:categories,id',
            'provider_id' => 'required|integer|exists:providers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El valor no es correcto.',
            'name.required' => 'Este campo es requerido.',
            'name.unique' => 'El producto ya esta registrado.',
            'name.max' => 'Solo se permiten 255 caracteres.',

            'image.required' => 'Este campo es requerido.',
            'image.dimensions' => 'La imagen debe tener un ancho mínimo de 100px y una altura mínima de 200px.',
            
            'price.required' => 'Este campo es requerido.',
            'price.numeric' => 'El valor no es correcto.',
            
            'category_id.integer' => 'El valor no es correcto.',
            'category_id.required' => 'Este campo es requerido.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
    
            'provider_id.integer' => 'El valor no es correcto.',
            'provider_id.required' => 'Este campo es requerido.',
            'provider_id.exists' => 'El proveedor seleccionado no existe.',
        ];
    }
}
