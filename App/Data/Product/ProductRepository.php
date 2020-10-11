<?php

namespace App\Data\Product;

use App\Data\FolderService;
use App\Db\Db;
use App\Data\Folder\FolderModel;
use App\Data\Product\ProductModel;
use App\Data\Product\ProductImageService as ProductImageService;

class ProductRepository {
    
    public function get_Spisok_Count(){
        $query='SELECT COUNT(*) AS c FROM products p LEFT JOIN folders f ON p.id_folder = f.id_folder';
        return Db::fetchOnce($query);
    }

    /**
     * @param int $id_product
     * @return ProductModel
     * @throws \Exception
     */
    public function getById(int $id_product) {

        $query="SELECT p.*, f.name_folder FROM products p LEFT JOIN folders f ON p.id_folder = f.id_folder WHERE id_product = $id_product";
        $productArray = Db::fetchRow($query);
        $product = $this->getProductFromArray($productArray);
        
        $productImageService = new ProductImageService;
        
        $imagesData = $productImageService->get_By_Product_Id($product->getId_product());
        foreach ($imagesData as $imageItem) {
                $productImage = $this->getProductImageFromArray($imageItem);
                $product->addImage($productImage);
        }
 //       echo "<pre>"; var_dump($product); echo "</pre>"; exit;
        return $product;
    }
    
    /**
     * 
     * @param array $data
     * @return ProductModel
     */
    public function getProductFromArray(array $data): ProductModel {
        $id_product = $data['id_product'];
            
            $name_product = $data['name_product'] ?? null;
            $price = $data['price'] ?? null;
            $amount = $data['amount'] ?? null;
            
            if (is_null($name_product)) {
                throw new \Exception('Название для инициализации товара обязательно');
            }
            if (is_null($price)) {
                throw new \Exception('Цена для инициализации товара обязательно');
            }
            if (is_null($amount)) {
                throw new \Exception('Количество для инициализации товара обязательно');
            }
            
            $article = $data['article'] ?? ''; 
            $description = $data['description'] ?? '';
            $id_folder = $data['id_folder'] ?? 0;
//                                            echo var_dump($id_folder);
//                    exit;
            $product = new ProductModel($name_product, $price, $amount);
            
            if ($id_folder > 0) {
                
                $name_folder = $data['name_folder'] ?? null;
                if (is_null($name_folder)) {
                    $folderData = FolderService::get_By_Id($id_folder);
//                    echo var_dump($folderData);
//                    exit;
                    $name_folder = $folderData['name_folder'];
                }
                $folder = new FolderModel($name_folder);
                $folder->setId_folder($id_folder);
//                                                echo var_dump($folder);
//                    exit;       
                $product->setFolder($folder);
                
            }

            $product
                    ->setId_product($id_product)
                    ->setArticle($article)
                    ->setDescription($description);
//                    ->setId_folder($id_folder);
//             echo var_dump($product);
//                    exit;
            return $product;
    }
    
    /**
     * 
     * @param int $limit
     * @param type $offset
     * @return Product[]
     */
    public function get_Spisok(int $limit = 50, $offset = 0) {
        $query='SELECT p.*, f.name_folder AS name_folder FROM products p LEFT JOIN folders f ON p.id_folder = f.id_folder LIMIT ' . $offset . ',' . $limit;
        $result = Db::query($query);
        
        $productImageService = new ProductImageService();
        
        $products = [];
//        echo var_dump(Db::fetchAssoc($result));
//                    exit;
        while ($productArray = Db::fetchAssoc($result)) {
            $product = $this->getProductFromArray($productArray);
//            echo var_dump($product);
//                    exit;
            $imagesData = $productImageService->get_By_Product_Id($product->getId_product());
            foreach ($imagesData as $imageItem) {
                $productImage = $this->getProductImageFromArray($imageItem);
                $product->addImage($productImage);
            }
            
            $products[] = $product;
            
        }    
        return $products;
    }
    
    /**
     * 
     * @param array $data
     * @return \App\Product\ProductImage
     */
    public function getProductImageFromArray(array $data): ProductImageModel {
        $productImage = new ProductImageModel();
        
        $productImage
                ->setId_image($data['id_image'])
                ->setName_image($data['name_image'])
                ->setPath($data['path'])
                ->setSize($data['size']);
        return $productImage;
    }
    
    public function save(ProductModel $product): ProductModel {
        $id_product= $product->getId_product();
//        echo var_dump($product);
//        exit;
        $productArray = $this->ProductToArray($product);
        if ($id_product) {
            Db::update('products', $productArray, "id_product = $id_product");
            return $product;
        }
        
        $id_product = Db::insert('products', $productArray);
        $product->setId_product($id_product);
        
        return $product;
    }
    
    public function ProductToArray(ProductModel $product) {
        $data = [
            'name_product' => $product->getName_product(),
            'article' => $product->getArticle(),
            'amount' => $product->getAmount(),
            'price' => $product->getPrice(),
            'description' => $product->getDescription(),
        ];
        
        $folder = $product->getFolder();
        if (!is_null($folder)) {
            $data['id_folder'] = $folder->getId_folder();
        }
        return $data;
    } 
    
}
