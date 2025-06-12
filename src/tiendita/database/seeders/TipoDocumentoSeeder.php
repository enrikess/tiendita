<?php

namespace Database\Seeders;

use App\Models\SisTipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposDocumento = [
            [
                'nombre' => 'Documento Nacional de Identidad',
                'abreviatura' => 'DNI',
            ],
            [
                'nombre' => 'Registro Único de Contribuyentes',
                'abreviatura' => 'RUC',
            ],
            [
                'nombre' => 'Carné de Extranjería',
                'abreviatura' => 'CE',
            ],
            [
                'nombre' => 'Pasaporte',
                'abreviatura' => 'PAS',
            ],
        ];

        foreach ($tiposDocumento as $tipoDocumento) {
            //SisTipoDocumento::create($tipoDocumento);
        }
    }
}
