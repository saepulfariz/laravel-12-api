# LARAVEL 12 API

## Setup

-   composer create-project --prefer-dist laravel/laravel:^12.0 laravel-12-api
-   change env FILESYSTEM_DISK=local to FILESYSTEM_DISK=public
-   php artisan storage:link
-   php artisan install:api
-   php artisan make:migration create_todos_table
-   php artisan make:model Todo / php artisan make:model Todo -m (migration)
-   php artisan make:model Todo --resource -m (Controller and migration)
-   php artisan migrate
-   php artisan make:controller TodoController / php artisan make:controller Api\TodoController / php artisan make:controller TodoController --resource
-   php artisan make:migration create_categories_table
-   php artisan make:migration add_category_id_to_todos_table
-   php artisan make:model Category

## Swagger API

-   composer require "darkaonline/l5-swagger"
-   php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
-   php artisan l5-swagger:generate
-   http://localhost:8000/api/

## Resource API

-   php artisan make:resource TodoResource
-   php artisan make:resource Todo --collection
-   php artisan make:resource TodoCollection

## Authentation

-   php artisan install:api
-   php artisan make:seeder UserSeeder
-   php artisan db:seed --class=UserSeeder
-   php artisan make:controller AuthController
