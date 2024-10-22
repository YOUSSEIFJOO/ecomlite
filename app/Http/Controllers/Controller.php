<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use App\Traits\LogTrait;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'My API',
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    description: 'Enter your bearer token in the format **Bearer &lt;token&gt;**',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]
abstract class Controller
{
    use ApiResponseTrait, LogTrait;
}
