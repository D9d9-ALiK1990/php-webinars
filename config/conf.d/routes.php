<?php

use App\Data\Folder\FolderController;
use App\Data\Import\ImportController;
use App\Data\Product\ProductController;
use App\Data\Queue\QueueController;

return [
    '/products' => [ProductController::class, 'list'],
    '/products/upd' => [ProductController::class, 'upd'],
    '/products/upd/{id_product}' => [ProductController::class, 'upd'],
    '/products/add' => [ProductController::class, 'add'],
    '/products/del' => [ProductController::class, 'del'],
    '/products/del_image' => [ProductController::class, 'del_image'],


    '/folders' => [FolderController::class, 'list'],
    '/folders/add' => [FolderController::class, 'add'],
    '/folders/upd' => [FolderController::class, 'upd'],
    '/folders/upd/{id_folder}' => [FolderController::class, 'upd'],
    '/folders/del' => [FolderController::class, 'del'],
    '/folders/view' => [FolderController::class, 'view'],
    '/folders/view/{id_folder}' => [FolderController::class, 'view'],

    '/queue' => [QueueController::class, 'list'],
    '/queue/run' => [QueueController::class, 'run'],

    '/import' => [ImportController::class, 'list'],
    '/import/upload' => [ImportController::class, 'upload'],
];
