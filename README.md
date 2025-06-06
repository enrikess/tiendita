# Tiendita - Laravel 12 + Vue 3 + Vite + Docker

Este proyecto es una plantilla moderna para aplicaciones Laravel 12 con Vue 3 y Vite, lista para desarrollo en Windows, Mac o Linux usando Docker. Incluye Apache, MySQL 8, Node.js, Composer y todas las extensiones necesarias para un flujo de trabajo fullstack.

## Requisitos
- Docker Desktop
- Docker Compose
- Git

## Instalación rápida

1. Clona este repositorio y entra al directorio:
   ```bash
   git clone <URL_DEL_REPO>
   cd tiendita
   ```
2. Levanta los contenedores (la primera vez usa --build):
   ```bash
   docker compose up -d --build
   ```
3. Instala dependencias de backend y frontend:
   ```bash
   docker compose exec app bash -c "cd /var/www/html/tiendita && composer install && npm install"
   ```
4. Configura el archivo `.env` de Laravel (`src/tiendita/.env`):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```
5. Ejecuta migraciones y compila assets:
   ```bash
   docker compose exec app bash -c "cd /var/www/html/tiendita && php artisan migrate && npm run build"
   ```
6. Accede a la app en tu navegador:
   - Backend (Laravel): [http://localhost](http://localhost)
   - Frontend (Vite dev server): [http://localhost:5173](http://localhost:5173) (ejecuta `npm run dev` manualmente si quieres hot reload)

## Desarrollo con Vite (hot reload)
Para desarrollo frontend con recarga en vivo:
```bash
# Deja esta terminal abierta
docker compose exec app bash -c "cd /var/www/html/tiendita && npm run dev -- --host 0.0.0.0 --port 5173"
```
Luego accede a [http://localhost:5173](http://localhost:5173)

## Comandos útiles
- `docker compose exec app bash` — Accede al contenedor para ejecutar comandos manualmente
- `composer`, `php artisan`, `npm`, `node`, `laravel` — Todos disponibles dentro del contenedor app
- `docker compose down` — Detiene y elimina los contenedores

## Notas importantes
- El puerto 5173 debe estar libre en tu host para usar Vite en modo desarrollo.
- Si no puedes acceder a Vite, asegúrate de dejar la terminal de `npm run dev` abierta.
- El entorno está listo para clonar y usar, sin instalar nada extra en tu máquina.

---

¿Dudas o problemas? Abre un issue o revisa la documentación oficial de [Laravel](https://laravel.com/docs), [Vue](https://vuejs.org/), [Vite](https://vitejs.dev/) y [Docker](https://docs.docker.com/).
