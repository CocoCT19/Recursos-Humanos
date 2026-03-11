# Recursos Humanos - Gestión de Colaboradores y Contratos (Laravel 11)

Aplicación Laravel 11 para gestionar Colaboradores y sus Contratos en un entorno de RR.HH. Incluye autenticación básica, CRUD de Colaboradores, creación/actualización de Contratos, soporte para extensiones y terminaciones de contrato a nivel de base de datos, y un conjunto de pruebas automatizadas bajo metodología TDD.


## Tecnologías y dependencias
- PHP >= 8.2
- Laravel 11
- MySQL (única base de datos soportada por este proyecto)
- Composer
- Node.js (para assets de Breeze/Tailwind si se usa la UI)
- Paquetes:
  - spatie/laravel-permission ^6.24 (configurado, sin usos en controladores aún)
  - laravel/breeze (dev) para scaffolding de auth/UI
  - phpunit ^10.5 para pruebas


## Estructura relevante
- app/Models
  - Collaborator.php (SoftDeletes, fillable de datos personales)
  - Contract.php (relaciones: collaborator, extensions, termination)
- app/Http/Controllers
  - AuthController.php (registro/login con sesiones)
  - CollaboratorController.php (index/store/edit/update/destroy)
  - ContractController.php (store/update)
- routes/web.php (endpoints HTTP principales)
- database/migrations
  - create_collaborators_table
  - create_contracts_table
  - create_contract_extensions_table
  - create_contract_terminations_table
- database/seeders (semillas de datos de ejemplo)
- tests/Feature (cobertura de casos TDD principales)
- docs/
  - CP_Colaboradores.md
  - CP_Contratos.md
  - CP_Prorroga_De_Contrato.md


## Instalación y configuración (MySQL)
1) Clonar el repositorio
- Opción CLI:
  git clone <URL_DEL_REPOSITORIO>
  cd RecursosHumanos

2) Instalar dependencias de PHP y JS
  composer install
  npm install

3) Variables de entorno (.env)
- Copiar el archivo de ejemplo y ajustar credenciales MySQL:
  cp .env.example .env

- Generar key de la app:
  php artisan key:generate

- Configurar MySQL en .env (este proyecto solo usa MySQL):
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=recursoshumanos
  DB_USERNAME=tu_usuario
  DB_PASSWORD=tu_password

Asegúrate de crear la base de datos vacía en tu servidor MySQL antes de migrar:
- CREATE DATABASE recursoshumanos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

4) Migraciones y seeders
  php artisan migrate
  php artisan db:seed

5) Servidor de desarrollo
  php artisan serve
- La app responderá en http://127.0.0.1:8000


## Autenticación básica
- Registro: POST /register
  - Campos: name, email, password, password_confirmation
  - Éxito: redirige a /dashboard y autentica la sesión
- Login: POST /login
  - Campos: email, password
  - Éxito: redirige a /dashboard
- Rutas protegidas usan middleware auth


## Endpoints principales (routes/web.php)
- GET /dashboard
  - Requiere auth, responde 200 con texto "Dashboard".

- Colaboradores (middleware: auth)
  - GET /collaborators
    - Retorna JSON con todos los colaboradores (200)
  - POST /collaborators
    - Crea colaborador, valida campos y redirige a /collaborators
    - Validaciones:
      - first_name, last_name, birth_date(date), email(email), phone_number, address: required
      - document_type: in: CC, CE, PPT
      - document_number: unique:collaborators
  - GET /collaborators/{id}/edit
    - Retorna JSON del colaborador por id (200)
  - PUT /collaborators/{id}
    - Actualiza y redirige a /collaborators
    - Validaciones como POST pero permite conservar document_number del propio registro
  - DELETE /collaborators/{id}
    - Soft delete, retorna { message: "Collaborator deleted" } (200)

- Contratos (middleware: auth)
  - POST /contracts (name: contracts.store)
    - Crea contrato y redirige a /contracts
    - Validaciones:
      - collaborator_id: exists:collaborators,id
      - contract_type: in: Fijo, Indefinido, Prestación de Servicios
      - start_date: date (required)
      - end_date: nullable|date|after_or_equal:start_date
      - position: string (required)
      - salary: numeric|min:0
      - status: in: Activo, Terminado, Finalizado
  - PUT /contracts/{id} (name: contracts.update)
    - Actualiza contrato, retorna JSON 200 con mensaje de éxito


## Esquema de base de datos (migraciones)
- collaborators
  - id (PK)
  - first_name, last_name
  - document_type: enum[CC, CE, PPT]
  - document_number: unique
  - birth_date (date)
  - email, phone_number, address
  - timestamps, deleted_at (soft deletes)

- contracts
  - id (PK)
  - collaborator_id (FK -> collaborators, cascade on delete)
  - contract_type: enum[Fijo, Indefinido, Prestación de Servicios]
  - start_date (date)
  - end_date (nullable date)
  - position (string)
  - salary (decimal 12,2)
  - status: enum[Activo, Terminado, Finalizado]
  - timestamps

- contract_extensions
  - id (PK)
  - contract_id (FK -> contracts, cascade on delete)
  - extension_type: enum[Tiempo, Valor]
  - new_end_date (nullable date)
  - additional_value (nullable decimal 12,2)
  - description (nullable text)
  - timestamps

- contract_terminations
  - id (PK)
  - contract_id (FK único -> contracts, cascade on delete)
  - termination_date (date)
  - reason (text)
  - timestamps


## Pruebas automatizadas (TDD)
Las pruebas de características cubren los flujos clave:
- tests/Feature/RegisterLoginCreateCollaboratorTest.php
  - Registro, login y creación de colaborador válidos (redirecciones y DB asserts)
- tests/Feature/DuplicateCollaboratorDocumentTest.php
  - Rechaza documento duplicado en creación
- tests/Feature/UpdateCollaboratorTest.php
  - Actualiza colaborador existente
- tests/Feature/ListCollaboratorsTest.php
  - Lista de colaboradores autenticado
- tests/Feature/DeleteCollaboratorTest.php
  - Soft delete de colaborador
- tests/Feature/CreateContractTest.php
  - Crea contrato para colaborador existente
- tests/Feature/Contracts/CreateContractWithInvalidCollaboratorTest.php
  - Falla si el collaborator_id no existe
- tests/Feature/Contracts/ContractValidationTest.php
  - Valida fechas y salario del contrato
- tests/Feature/Contracts/UpdateContractTest.php
  - Actualiza contrato existente
- tests/Feature/Contracts/ExtensionAllowedContractTypesTest.php
  - Asegura que extensiones aplican a tipos permitidos (a nivel de pruebas/dominio)

Ejecución de pruebas (con base de datos MySQL configurada):
  php artisan test
  # o
  vendor\bin\phpunit

Asegúrate que tu .env de testing también apunte a una base MySQL accesible. Puedes usar la misma DB y RefreshDatabase se encargará de migrar en cada test, o crear una DB específica para tests (p. ej. recursoshumanos_test).


## Semillas de datos
Existen seeders para poblar información de ejemplo:
- Database\Seeders\CollaboratorSeeder
- Database\Seeders\ContractSeeder
- Database\Seeders\ContractExtensionSeeder
- Database\Seeders\ContractTerminationSeeder

Ejecutar:
  php artisan db:seed


## Seguridad y middleware
- Las rutas de colaboradores y contratos están protegidas por middleware auth (sesiones).
- Paquete spatie/laravel-permission instalado; no hay políticas/roles explícitos en controladores aún.


## Notas de implementación
- Collaborator implementa SoftDeletes; DELETE no elimina físicamente.
- Los controladores devuelven mezcla de JSON y redirecciones según acción (diseñado para pruebas y flujos simples).
- Las vistas Blade de autenticación/boilerplate están presentes vía Breeze; el enfoque principal de este repo es la API sencilla + TDD.


## Comandos útiles
- Migraciones desde cero: php artisan migrate:fresh --seed
- Servidor: php artisan serve
- Limpiar cachés: php artisan optimize:clear


