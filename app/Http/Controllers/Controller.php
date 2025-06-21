<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="LARAVEL 12 API", version="0.1")
 * @OA\PathItem(path="/api")
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Server Online"
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Server Local"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Use your Bearer Token to authenticate"
 * )
 */
abstract class Controller
{
    //
}
