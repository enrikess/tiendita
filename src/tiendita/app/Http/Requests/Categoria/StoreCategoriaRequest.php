<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        return true; // o implementa tu lógica de autorización
    }

    /**
     * Prepara los datos para la validación.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
    }

    /**
     * Obtiene las reglas de validación que aplican a la petición.
     */
    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:100',
            'estado' => 'boolean|sometimes',
        ];

        // No añadimos más validaciones ya que el modelo no tiene los campos adicionales

        return $rules;
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El NOMBRE es obligatorio',
            'nombre.max' => 'El NOMBRE no puede tener más de 50 caracteres',

            'descripcion.max' => 'El NOMBRE no puede tener más de 100 caracteres',

        ];
    }
}
