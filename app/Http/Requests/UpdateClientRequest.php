<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'string|required|max:255',
            'dni' => 'string|required|unique:clients,dni,'.$this->route('client')->id.'|max:8|min:8',
            'ruc' => 'nullable|string|unique:clients,ruc,'.$this->route('client')->id.'|max:11|min:11',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|nullable|max:9|min:9|unique:clients,phone,'.$this->route('client')->id,
            'email' => 'nullable|string|nullable|email|max:255|unique:clients,email,'.$this->route('client')->id.'|email:rfc,dns',
        ];
    }
    public function messages(): array
    {
        return [
            'name.string' => 'El valor no es correcto.',
            'name.required' => 'Este campo es requerido.',
            'name.max' => 'Solo se permiten 255 caracteres.',

            'dni.string' => 'El valor no es correcto.',
            'dni.required' => 'Este campo es requerido.',
            'dni.unique' => 'El DNI ya existe.',
            'dni.max' => 'Solo se permiten 8 caracteres.',
            'dni.min' => 'Solo se permiten 8 caracteres.',

            'ruc.string' => 'El valor no es correcto.',
            'ruc.unique' => 'El RUC ya existe.',
            'ruc.max' => 'Solo se permiten 11 caracteres.',
            'ruc.min' => 'Solo se permiten 11 caracteres.',

            'address.string' => 'El valor no es correcto.',
            'address.max' => 'Solo se permiten 255 caracteres.',

            'phone.string' => 'El valor no es correcto.',
            'phone.max' => 'Solo se permiten 9 caracteres.',
            'phone.min' => 'Solo se permiten 9 caracteres.',
            'phone.unique' => 'El teléfono ya existe.',

            'email.string' => 'El valor no es correcto.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.max' => 'Solo se permiten 255 caracteres.',
            'email.unique' => 'El correo electrónico ya existe.',
        ];
    }
}
