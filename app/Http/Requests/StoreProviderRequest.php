<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:providers,name',
            'email' => 'required|email|unique:providers,email|string|max:255',
            'ruc_number' => 'required|string|max:11|min:11|unique:providers,ruc_number',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:9|min:9|unique:providers,phone',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permiten 255 caracteres.',
            'name.unique' => 'El proveedor ya existe.',
            
            'email.required' => 'Este campo es requerido.',
            'email.email' => 'El valor no es correcto.',
            'email.unique' => 'El correo ya existe.',
            'email.string' => 'El valor no es correcto.',
            'email.max' => 'Solo se permiten 255 caracteres.',

            'ruc_number.required' => 'Este campo es requerido.',
            'ruc_number.string' => 'El valor no es correcto.',
            'ruc_number.max' => 'Solo se permiten 11 caracteres.',
            'ruc_number.min' => 'Solo se permiten 11 caracteres.',
            'ruc_number.unique' => 'El RUC ya existe.',

            'address.string' => 'El valor no es correcto.',
            'address.max' => 'Solo se permiten 255 caracteres.',

            'phone.required' => 'Este campo es requerido.',
            'phone.string' => 'El valor no es correcto.',
            'phone.max' => 'Solo se permiten 9 caracteres.',
            'phone.min' => 'Solo se permiten 9 caracteres.',
            'phone.unique' => 'El teléfono ya existe.',

        ];
    }
}
