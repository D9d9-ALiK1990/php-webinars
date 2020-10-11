<?php

namespace App\Data\Product;

use App\Data\Folder\FolderModel;

class ProductModel {
    
    /**
     * @var int
     */
    protected $id_product = 0;
    
    /**
     * @var string
     */
    protected $name_product;
    
    /**
     * @var string
     */
    protected $article = '';
    
    /**
     * @var int
     */
    protected $amount;
    
    /**
     * @var float
     */
    protected $price;
    
    /**
     * @var string
     */
    protected $description = '';
    
    /**
     * @var Folder
     */
    protected $folder;
    
    /**
     * @var array
     */
    protected $images = [];
    
    public function __construct(string $name_product, float $price, int $amount) {
        $this->setName_product($name_product);
        $this->setPrice($price);
        $this->setAmount($amount);        
    }
    
    /**
     * 
     * @return int
     */
    public function getId_product() {
        return $this->id_product;    
    }
    
    /**
     * 
     * @param int $id_product
     * @return $this
     */
    public function setId_product(int $id_product) {
        $this->id_product=$id_product;
        return $this;
    }
    /**
     * 
     * @return string
     */
    public function getName_product() {
        return $this->name_product;    
    }
    
    /**
     * 
     * @param string $name_product
     * @return $this
     */
    public function setName_product(string $name_product) {
        $this->name_product=$name_product;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getArticle() {
        return $this->article;    
    }
    
    /**
     * 
     * @param string $article
     * @return $this
     */
    public function setArticle(string $article) {
        $this->article=$article;
        return $this;
    }
    
    /**
     * 
     * @return int
     */
    public function getAmount() {
        return $this->amount;    
    }
    
    /**
     * 
     * @param int $amount
     * @return $this
     */
    public function setAmount(int $amount) {
        $this->amount=$amount;
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function getPrice() {
        return $this->price;    
    }
    
    /**
     * 
     * @param int $price
     * @return $this
     */
    public function setPrice(int $price) {
        $this->price=$price;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getDescription() {
        return $this->description;    
    }
    
    /**
     * 
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description) {
        $this->description=$description;
        return $this;
    }
    
    /**
     * 
     * @return FolderModel|null
     */
    public function getFolder(): ?FolderModel {
        return $this->folder;    
    }
    
    /**
     * 
     * @param FolderModel $folder
     * @return ProductModel
     */
    public function setFolder(FolderModel $folder): ProductModel {
        $this->folder=$folder;
        return $this;
    }
    
    /**
     * 
     * @return ProductImage[]
     */
    public function getImages() {
        return $this->images;    
    }
    
    /**
     * 
     * @param array $images
     * @return ProductModel
     */
    public function setImages(array $images): ProductModel {
        $this->images=$images;
        return $this;
    }
    
    /**
     * 
     * @param \App\Product\ProductImageModel $productImage
     * @return \App\Product\ProductModel
     */
    public function addImage(ProductImageModel $productImage): ProductModel {
        $this->images[] = $productImage;
        return $this;
    }

}
