<?php

namespace App\Http\Requests\Proveedores;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
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
        if ($this->has('ruc')) {
            // Limpia espacios y caracteres no deseados del RUC
            $this->merge([
                'ruc' => preg_replace('/[^0-9]/', '', $this->ruc)
            ]);
        }
    }

    /**
     * Obtiene las reglas de validación que aplican a la petición.
     */
    public function rules(): array
    {
        $rules = [
            'ruc' => 'required|string|max:11|unique:com_proveedores,ruc',
            'razon_social' => 'required|string|max:100',
            'nombre_comercial' => 'nullable|string|max:100',
            'direccion' => 'required|string|max:200',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100',
            'persona_contacto' => 'nullable|string|max:100',
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
            'ruc.required' => 'El RUC es obligatorio',
            'ruc.unique' => 'Este RUC ya está registrado',
            'razon_social.required' => 'La razón social es obligatoria',
            'direccion.required' => 'La dirección es obligatoria',
            'email.email' => 'El formato del email no es válido',
            'tipo_cuenta.required' => 'Si proporciona un número de cuenta, debe especificar el tipo de cuenta',
            'banco.required' => 'Si proporciona un número de cuenta, debe especificar el banco',
        ];
    }
}
