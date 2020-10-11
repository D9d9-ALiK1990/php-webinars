<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\SharedData;
use App\Middleware\CartMiddleware;

return [
    AuthMiddleware::class,
    SharedData::class,
    CartMiddleware::class,
];
