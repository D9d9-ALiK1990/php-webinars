<?php

namespace App\Data\Product;

use App\Db\Db;

class ProductImageService {
    
    private CONST IMAGE_MIME_DICTIONARY = [
        'image/apng' => '.apng',
        'image/bmp' => 'bmp',
        'image/gif' => '.gif',
        'image/x-icon' => '.ico',
        'image/jpeg' => '.jpg',
        'image/png' => '.png',
        'image/svg' => '.svg',
        'image/tiff' => '.tiff',
        'image/webp' => '.webp',
    ];
    
    public  function get_By_Id(int $id_image) {
        $query="SELECT * FROM product_images WHERE id_image = $id_image";
        return Db::fetchRow($query);
    }
    
    public function findByFileNameInProduct(int $id_product, string $filename) {
        $query="SELECT * FROM product_images WHERE id_product = $id_product AND name_image = '$filename'";
        return Db::fetchRow($query);
    }

    public function update_By_Id($id_image, array $productImage): int {
        if (isset($productImage['id_image'])){
            unset($productImage['id_image']);
        }
        return Db::update('product_images', $productImage, "id_image = $id_image");
    }

    public function add(array $productImage) {
        if (isset($productImage['id_image'])) {
            unset($productImage['id_image']);
        }
        return Db::insert('product_images', $productImage);
    }

    public function delete_By_Id($id_image) {
        $productImage = $this->get_By_Id($id_image);
        $filepath = APP_PUBLIC_DIR . $productImage['path'];
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        return Db::delete('product_images', "id_image = $id_image");
    }
    
    public function delete_By_Product_Id(int $id_product) {
        return Db::delete('product_images', "id_product = $id_product");
    }
    
    public function get_By_Product_Id(int $id_product) {
        $query="SELECT * FROM product_images WHERE id_product = $id_product";
        return Db::fetchAll($query);
    }
    
    public function uploadImages(int $id_product, array $files) {
        $this->checkProductDir($id_product);
        $path = APP_UPLOAD_PRODUCT_DIR . '/' . $id_product;
        $imageNames = $files['name'];
        $imageTmpNames = $files['tmp_name'];
        $imagesCount = 0;

        for ($i =0; $i < count($imageNames); $i++) {
            $imageName = basename(trim($imageNames[$i]));
            if (empty($imageName)) {
                continue;
            }
            $imageTmpName = $imageTmpNames[$i];
            $filename = $this->getUniqueUploadImageName($id_product, $imageName); 
//            $filename = $imageName;
//            $imageCounter = 0;
//            
//            while (true) {
//                $duplicateImage = ProductImage::findByFileNameInProduct($id_product, $filename);
//                if (empty($duplicateImage)) {
//                    break;
//                }
//                
//               $info = pathinfo($imageName);
//               $filename = $info['filename'];
//               $filename .= '_' . $imageCounter . '.' . $info['extension'];
//               
//               $imageCounter++;                  
//            }
            $imagePath = $path . '/' . $filename;    
            move_uploaded_file($imageTmpName, $imagePath);

            $this->add([
                'id_product' => $id_product,
                'name_image' => $imageName,
                'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath),

            ]);
        }
        return $imageCounter;
    }
    
//    public function uploadImage(int $id_product, array $file) {
//        
//    }
    
    protected function getUniqueUploadImageName(int $id_product, string $imageName) {
        $filename = $imageName;
            $imageCounter = 0;
            
            while (true) {
                $duplicateImage = ProductImageService::findByFileNameInProduct($id_product, $filename);
                if (empty($duplicateImage)) {
                    break;
                }
                
               $info = pathinfo($imageName);
               $filename = $info['filename'];
               $filename .= '_' . $imageCounter . '.' . $info['extension'];
               
               $imageCounter++;                  
            }
        return $filename;
    }
    
    public function uploadImageByUrl(int $id_product, string $imageUrl) {
        $path = $this->checkProductDir($id_product); 
        if (empty($imageUrl)) {
           return false;
        }
            $imageContentTypes = static::IMAGE_MIME_DICTIONARY;
            $imagePath = $path . '/';
            
            $imageMetaData = $this->getMetaDataByUrl($imageUrl);
            $mimeType = $imageMetaData['mimeType'];
            

            
            if (is_null($mimeType)) {
                return false;
            }
            
            $imageExt = $this->getExtentionByMimeType($mimeType);
            
            if (is_null($imageExt)) {
                return false;
            }
            
            $size = $imageMetaData['size'];
            if (is_null($size)) {
                return false;
            }
            
            $dublicateProductImage = ProductImageService::getByProductAndSize($id_product, $size);
            if (!empty($dublicateProductImage)) {
                return false;
            }
            
            $productImageId =  ProductImageService::add([
                'id_product' => $id_product,
                'name_image' => '',
                'path' => '',
                'size' => $size,
            ]);

            $filename = $id_product . '_' . $productImageId . '_upload' . time() . $imageExt;
            $imagePath .= $filename;
            
            file_put_contents($imagePath, fopen($imageUrl, 'r'));
            
            
            
            ProductImageService::update_By_Id($productImageId, [
                'name_image' => $filename,
                'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath),
            ]);
        return true;
    }
    
    
    protected function checkProductDir(int $id_product) {
        $path = APP_UPLOAD_PRODUCT_DIR . '/' . $id_product;

        if (!file_exists($path)) {
            mkdir($path);
        }
        return $path;
    }

    protected function getExtentionByUrl(string $imageUrl) {
        $metaData = $this->getMetaDataByUrl($imageUrl);
        $mimeType = $metaData['mimeType'];
        return static::IMAGE_MIME_DICTIONARY[$contentType] ?? null;
    }
    
    protected function getExtentionByMimeType(string $mimeType) {
        return static::IMAGE_MIME_DICTIONARY[$mimeType] ?? null;
    }

    
    protected function getMetaDataByUrl(string $imageUrl) {
        $headers = get_headers($imageUrl);

            if ($headers === false) {
                return null;
            }
            
            $metaDataHeaders = [
                'Content-Length',
                'Content-Type',
            ];
            
            $metaData = [
                'mimeType' => null,
                'size' => null,
            ];
            
            $mimeType = null;

            foreach ($headers as $headerStr) {
                
                $header = null;
                foreach ($metaDataHeaders as $metaDataHeader) {
                    if (strpos(strtolower($headerStr), strtolower($metaDataHeader)) === false) {
                        continue;
                    }
                    $header = $metaDataHeader;

                    break;
                }
                
                if (is_null($header)) {
                    continue;
                }
                
                
                $headerData = explode(':', $headerStr);

                $headerValue = trim(strtolower($headerData[1] ?? ''));
                switch ($header) {
                    case 'Content-Length':
                        $metaData['size'] = $headerValue;
                        break;
                    case 'Content-Type':
                        $metaData['mimeType'] = $headerValue;
                        break;
                }
            }                        
        return $metaData;    
    }
    
    private function getByProductAndSize(int $id_product, int $size) {
        $query = "SELECT * FROM product_images WHERE id_product = $id_product AND size = $size";
        return Db::fetchRow($query);
    }
//    public function getDataFromPost() {
//        return [
//          'id_product' => Request::getIntFromPost('id_product', false),  
//          'name_product' => Request::getStrFromPost('name_product', ''),  
//          'article' => Request::getStrFromPost('article', ''),  
//          'price' => Request::getIntFromPost('price', ''),  
//          'amount' => Request::getIntFromPost('amount', ''),  
//          'description' => Request::getStrFromPost('description', ''),  
//          'id_folder' => Request::getIntFromPost('id_folder', ''),  
//        ];
//    }
}
