<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        {{-- Meta tags para configuración básica de la página --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Script inline para detectar el modo oscuro del sistema y aplicarlo inmediatamente --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Estilos inline para configurar el color de fondo según el tema --}}
        <style>
            html {
                background-color: oklch(1 0 0); {{-- Color claro por defecto --}}
            }

            html.dark {
                background-color: oklch(0.145 0 0); {{-- Color oscuro para el modo oscuro --}}
            }
        </style>

        {{-- Título dinámico de la página usando Inertia --}}
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        {{-- Iconos para la página (favicon y otros) --}}
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        {{-- Preconexión para cargar fuentes externas más rápido --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        {{-- Directiva para generar rutas de Laravel en JavaScript --}}
        @routes

        {{-- Directiva para incluir los assets compilados por Vite --}}
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])

        {{-- Directiva de Inertia para insertar metadatos específicos de la página --}}
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        {{-- Renderiza el componente principal de Inertia --}}
        @inertia
    </body>
</html>
