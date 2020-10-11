<?php

namespace App\Data\Product;

class ProductImageModel {
    
    /**
     *
     * @var int 
     */
    protected $id_image;
    
    /**
     *
     * @var Product 
     */
    protected $product;
    
    /**
     *
     * @var string
     */
    protected $name_image;
    
    /**
     *
     * @var string 
     */
    protected $path;
    
    /**
     *
     * @var int 
     */
    protected $size;
    
    /**
     * 
     * @return int
     */
    public function getId_image() {
        return $this->id_image;
    }
    
    /**
     * 
     * @param int $id_image
     * @return ProductImageModel
     */
    public function setId_image(int $id_image): ProductImageModel {
        $this-> id_image = $id_image;
        return $this;
    }
    
    /**
     * 
     * @return Product
     */
    public function getProduct() {
        return $this->product;
    }
    
    /**
     * 
     * @param ProductModel $product
     * @return ProductImageModel
     */
    public function setProduct(ProductModel $product): ProductImageModel {
        $this-> product = $product;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getName_image() {
        return $this->name_image;
    }
    
    /**
     * 
     * @param string $name_image
     * @return ProductImageModel
     */
    public function setName_image(string $name_image): ProductImageModel {
        $this-> name_image = $name_image;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getPath() {
        return $this->path;
    }
    
    /**
     * 
     * @param string $path
     * @return : ProductImageModel
     */
    public function setPath(string $path): ProductImageModel {
        $this-> path = $path;
        return $this;
    }
    
    /**
     * 
     * @return int
     */
    public function getSize() {
        return $this->size;
    }
    
    /**
     * 
     * @param int $size
     * @return ProductImageModel
     */
    public function setSize(int $size): ProductImageModel {
        $this-> size = $size;
        return $this;
    }
}
