<?php

namespace App\Data\Product;

use App\Db\Db;
use App\Http\Request;
use App\FS\FS;
use App\Data\Product\ProductImageService;

class ProductService {
    
    public function get_Spisok(int $limit = 100, int $offset = 0){
        $query='SELECT p.*, f.name_folder FROM products p LEFT JOIN folders f ON p.id_folder = f.id_folder LIMIT ' . $offset . ',' . $limit;
        $products = Db::fetchAll($query);
        foreach ($products as &$product) {
            $imagesData = ProductImage::get_By_Product_Id($product['id_product']);
            
//            $product['images'] = $images;
        }
        return $products;
    }

    

    public function get_By_Id_Folder($id_folder) {
        $query="SELECT p.*, f.name_folder FROM products p LEFT JOIN folders f ON p.id_folder = f.id_folder WHERE p.id_folder = $id_folder";
        return Db::fetchAll($query);
    }

    public function get_By_Id($id_product) {
        $query="SELECT p.*, f.name_folder FROM products p LEFT JOIN folders f ON p.id_folder = f.id_folder WHERE id_product = $id_product";
        $product = Db::fetchRow($query);
        
        $product['images'] = ProductImage::get_By_Product_Id($id_product);
                
        return $product;
    }

    public function update_By_Id($id_product, $product) {
        if (isset($product['id_product'])){
            unset($product['id_product']);
        }

        return Db::update('products', $product, "id_product = $id_product");
    }

    public function add($product) {
        if (isset($product['id_product'])){
            unset($product['id_product']);
        }
        return Db::insert('products', $product);
    }

    public function delete_By_Id($id_product) {

        $path = APP_UPLOAD_PRODUCT_DIR . '/' . $id_product;
        $fs = new FS();
        $fs->deleteDir($path);

        $productImageService = new ProductImageService();
        $productImageService->delete_By_Product_Id($id_product);

        return Db::delete('products', "id_product = $id_product");
    }
    
    public function getDataFromPost(Request $request) {
        return [
          'id_product' => $request->getIntFromPost('id_product', false),  
          'name_product' => $request->getStrFromPost('name_product', ''),  
          'article' => $request->getStrFromPost('article', ''),  
          'price' => $request->getIntFromPost('price', ''),  
          'amount' => $request->getIntFromPost('amount', ''),  
          'description' => $request->getStrFromPost('description', ''),  
          'id_folder' => $request->getIntFromPost('id_folder', ''),  
        ];
    }
    
    public function getByField(string $mainField, string $value){
        $mainField = Db::escape($mainField);
        $value = Db::escape($value);        
        $query = "SELECT * FROM products WHERE $mainField = '$value'";
        return Db::fetchRow($query);
    }
}
