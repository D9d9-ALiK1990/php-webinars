<?php

namespace App\Data\Product;

use App\Data\Folder\FolderModel;
use App\Model\AbstractModel;

/**
 * Class ProductModel
 * @package App\Data\Product
 *
 * @Model\Table("products")
 */
class ProductModel extends AbstractModel {
    
    /**
     * @var int
     * @Model\Id
     */
    protected $id = 0;
    
    /**
     * @var string
     * @Model\TableField
     */
    protected $name_product;
    
    /**
     * @var string
     * @Model\TableField
     */
    protected $article = '';
    
    /**
     * @var int
     * @Model\TableField
     */
    protected $amount;
    
    /**
     * @var float
     * @Model\TableField
     */
    protected $price;
    
    /**
     * @var string
     * @Model\TableField
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
    
    //public function __construct(string $name_product, float $price, int $amount)
    public function __construct()
    {
//        $this->setName_product($name_product);
//        $this->setPrice($price);
//        $this->setAmount($amount);
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
    
    /**
     * 
     * @param int $id
     * @return $this
     */
    public function setId(int $id) {
        $this->id = $id;
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
