<?php

namespace App\Data;

use App\Db\Db;

class Import {
    public static function productsFromFileTask(array $params) {
        $filename = $params['filename'] ?? '';
        if (is_null($filename)) {
            return false;
        }
        $uploadDir = APP_UPLOAD_DIR . '/import';
        $filepath = $uploadDir . '/' . $filename;
        $file = fopen($filepath, 'r');

        $withHeader = true;
        $settings = [
            0 => 'name_product',
            1 => 'name_folder',
            2 => 'article',
            3 => 'price',
            4 => 'amount',
            5 => 'description',
            6 => 'image_urls',
        ];

        $mainField = 'article';

        if ($withHeader === true) {
            $row = fgetcsv($file);
        }

        while($row = fgetcsv($file)) {
            $productData = [];

            foreach ($settings as $index => $key) {
                $productData[$key] = $row[$index] ?? null;
            }

            $product = [
               'name_product' => Db::escape($productData['name_product']), 
               'article' => Db::escape($productData['article']), 
               'price' => Db::escape($productData['price']), 
               'amount' => Db::escape($productData['amount']), 
               'description' => Db::escape($productData['description']), 
            ];

            $folderName = $productData['name_folder'];
            $folder = FolderService::getByName($folderName);
            if (empty($folder)) {
                $folderId = FolderService::add([
                    'name_folder' => $folderName
                ]);
            } else {
                $folderId = $folder['id_folder'];
            }

            $product['id_folder'] = $folderId;

            $targetproduct = Product::getByField($mainField, $product[$mainField]);
            if (empty($targetproduct)) {
                $id_product = Product::add($product);
            } else {
                $id_product = $targetproduct['id_product'];
                $targetproduct = array_merge($targetproduct, $product);
                Product::update_By_Id($id_product, $targetproduct);
            }

            $productData['image_urls'] = explode("\n", $productData['image_urls']);
            $productData['image_urls'] = array_map(function($item) {
                return trim($item);
            }, $productData['image_urls']);
            $productData['image_urls'] = array_filter($productData['image_urls'], function($item) {
                return !empty($item);
            });
        //    echo "<pre>"; var_dump($id_product); echo "</pre>";
        //    exit;
            foreach ($productData['image_urls'] as $imageUrl) {
                ProductImageService::uploadImageByUrl($id_product, $imageUrl);
            }
        }
        return true;
    }
}
