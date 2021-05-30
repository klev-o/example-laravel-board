<?php

namespace App\Http\Controllers\Api;

/**
 * @OA\Swagger(
 *     basePath="/api",
 *     host="localhost:8080",
 *     schemes={"https"},
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Board API",
 *         description="HTTP JSON API",
 *     ),
 *     @OA\SecurityScheme(
 *         securityScheme="OAuth2",
 *         type="oauth2",
 *         flow="password",
 *         tokenUrl="https://localhost:8080/oauth/token"
 *     ),
 *     @OA\SecurityScheme(
 *         securityScheme="Bearer",
 *         type="apiKey",
 *         name="Authorization",
 *         in="header"
 *     ),
 *     @OA\Schema(
 *         schema="ErrorModel",
 *         type="object",
 *         required={"code", "message"},
 *         @OA\Property(
 *             property="code",
 *             type="integer",
 *         ),
 *         @OA\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */
class HomeController
{
    /**
     * @OA\Get(
     *     path="/",
     *     tags={"Info"},
     *     @OA\Response(
     *         response="200",
     *         description="API version",
     *         @OA\Schema(
     *             type="object",
     *             @OA\Property(property="version", type="string")
     *         ),
     *     )
     * )
     */
    public function home()
    {
        return [
            'name' => 'Board API',
        ];
    }
}
