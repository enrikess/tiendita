<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class CfgCorrelativo extends Model
{
    use HasFactory;

    protected $table = 'cfg_correlativos';

    protected $fillable = [
        'tipo_documento',
        'serie',
        'anio',
        'ultimo_numero',
        'fecha_actualizacion',
        'estado',
    ];

    public $timestamps = false;

    /**
     * Accesor para mostrar el número formateado como SERIE-NUMERO
     * Ejemplo: 001-00000042
     *
     * @return string
     */
    public function getCorrelativoFormateadoAttribute(): string
    {
        return $this->serie . '-' . str_pad($this->ultimo_numero, 8, '0', STR_PAD_LEFT);
    }

    /**
     * Sobrescribe la fecha_actualizacion al actualizar el modelo
     */
    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->fecha_actualizacion = Carbon::now();
        });
    }

    /**
     * Genera y guarda el siguiente número correlativo para un tipo/serie/año
     *
     * @param string $tipo
     * @param string $serie
     * @param int $anio
     * @return string
     */
    public static function generarSiguienteNumero(string $tipo, string $serie, int $anio): string
    {
        // Busca o crea el correlativo
        $correlativo = self::firstOrCreate(
            [
                'tipo_documento' => $tipo,
                'serie' => $serie,
                'anio' => $anio,
            ],
            [
                'ultimo_numero' => 0,
                'estado' => true,
            ]
        );

        // Incrementa y guarda
        $correlativo->ultimo_numero += 1;
        $correlativo->save();

        // Devuelve como: 001-00000042
        return $correlativo->serie . '-' . str_pad($correlativo->ultimo_numero, 8, '0', STR_PAD_LEFT);
    }
}
