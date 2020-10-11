<?php

use App\Http\Request;
use App\Http\Response;
use App\Renderer\Renderer;
use App\Middleware\AuthMiddleware;
use App\Data\Cart\CartItem;
use App\Data\Cart\Cart;
use App\Middleware\CartMiddleware;
use App\Middleware\SharedData;
use App\Model;
use App\Utils\ReflectionUtil;
use App\Utils\StringUtil;
use App\Utils\DocParser;
use App\Data\Shop\Order\OrderRepository;
use App\Model\ModelAnalyzer;

return [
    ReflectionUtil::class,
    StringUtil::class,
    DocParser::class,
    Request::class,
    Response::class,
    Renderer::class,
    ModelManager::class,
    AuthMiddleware::class,
    CartMiddleware::class,
    SharedData::class,
    ModelAnalyzer::class,
    OrderRepository::class,

];

