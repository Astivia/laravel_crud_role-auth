# Sistema de Gestión de Usuarios y Control de Permisos

## Descripción del Proyecto

Esta es una aplicación web desarrollada para gestionar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) de usuarios, integrando un sistema de autenticación seguro y control de acceso basado en roles y permisos.

El proyecto está construido sobre una arquitectura moderna utilizando:

- **Backend:** Laravel 10 (PHP 8.1)
- **Frontend:** Vue.js 3 a través de Inertia.js (Laravel Breeze)
- **Base de Datos:** MySQL

## Flujo de Trabajo Git (Git Flow)

Para mantener un historial de desarrollo limpio y organizado, este proyecto sigue un flujo de trabajo estructurado basado en las siguientes ramas:

- **`main`**: Contiene el código de producción estable. Solo recibe fusiones (merges) desde la rama `release` cuando una versión está completamente probada.
- **`develop`**: Es la rama principal de integración de desarrollo. Aquí se unifican todas las nuevas características antes de prepararlas para un lanzamiento.
- **`feature/<nombre>`**: Ramas temporales creadas a partir de `develop` para trabajar en funcionalidades específicas (ej. `feature/setup-laravel`, `feature/crud-usuarios`). Al finalizar, se fusionan de vuelta a `develop`.
- **`release`**: Se crea a partir de `develop` cuando se agrupan suficientes características para una nueva versión. Aquí se realizan pruebas finales antes de fusionar hacia `master` y retroalimentar a `develop`.

## Instrucciones de Configuración y Ejecución

Sigue estos pasos para levantar el proyecto en un entorno local:

1. **Clonar el repositorio:**
   bash
   git clone https://github.com/Astivia/laravel_crud_role-auth.git
   cd laravel_crud_role-auth

2. **Instalar dependencias del Backend y Frontend:**
   bash
   composer install
   npm install
   npm run build

3. **Generar clave de aplicación**
   bash
   php artisan key:generate

4. **Configuración de Entorno:**
   Duplicar el archivo ".env.example" y renómbralo a ".env"
   Configurar credenciales de base de datos MySQL en el archivo ".env"

    ```bash
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nombre_de_tu_base_de_datos
     DB_USERNAME=tu_usuario
     DB_PASSWORD=tu_contraseña
    ```

5. **Ejecutar migraciones de base de datos:**
   bash
   php artisan migrate --seed

6. **Iniciar los servidores de desarrollo:**
    - **Laravel (Backend):** php artisan serve
    - **Vite (Frontend):** npm run dev

## Cuentas de Usuario de Prueba

email: admin@admin.com
password: password
