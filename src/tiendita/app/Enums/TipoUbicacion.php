<?php

namespace App\Enums;

enum TipoUbicacion: string
{
    case ALMACEN = 'ALMACEN';
    case TIENDA = 'TIENDA';

    /**
     * Obtener todos los valores como array
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Obtener todas las opciones para formularios
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::ALMACEN->value => 'Almacén',
            self::TIENDA->value => 'Tienda',
        ];
    }
}
