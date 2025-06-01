# LARAVEL 12 API

## Setup

-   composer create-project --prefer-dist laravel/laravel:^12.0 laravel-12-api
-   change env FILESYSTEM_DISK=local to FILESYSTEM_DISK=public
-   php artisan storage:link
-   php artisan install:api
-   php artisan make:migration create_todos_table
-   php artisan make:model Todo / php artisan make:model Todo -m (migration)
-   php artisan migrate
