<?php


namespace App\Data\Cart;


use App\Data\Cart\CartItem;
use App\Data\Product\ProductModel;

class Cart
{
    /**
     * @var CartItem[]
     */
    private $items = [];

    /**
     * @param CartItem $cartItem
     * @return bool
     */
    public function addItem(CartItem $cartItem)
    {
        if (in_array($cartItem, $this->items)) {
            return false;
        }

        $key = $cartItem->getProductModel()->getId_product();
   //     echo "<pre>"; var_dump($key); echo "</pre>"; exit;
        $this->items[$key] = $cartItem;
        return true;
    }

    public function removeItem(CartItem $cartItem)
    {
        $key = $cartItem->getProductModel()->getId_product();

        if ($key === false) {
            return false;
        }

        unset($this->items[$key]);
        return true;
    }

    public function addProduct(int $amount, ProductModel $productModel)
    {
        if ($productModel->getId_product() < 1) {
            return false;
        }

        $cartItem = $this->findItem($productModel);
        if (is_null($cartItem)) {
            $cartItem = new CartItem(0, $productModel);
        }

        $amount += $cartItem->getAmount();
        $cartItem->setAmount($amount);

       
         $this->addItem($cartItem);
         return true;
    }

    public function removeProduct(ProductModel $productModel)
    {
//        $key = $productModel->getId_product();
//
//        if (!in_array($key, $this->items)) {
//            return false;
//        }
//        unset($this->items[$key]);
//        return true;
        $item = $this->findItem($productModel);

        if (is_null($item)) {
            return false;
        }
        return $this->removeItem($item);
    }

    public function changeAmount(int $amount, ProductModel $productModel)
    {
         $item = $this->findItem($productModel);

         if (is_null($item)) {
             return false;
         }

         $amount = $item->getAmount() + $amount;

         $item->setAmount($amount);
         return true;
    }

    /**
     * @param ProductModel $productModel
     * @return \App\Data\Cart\CartItem|null
     */
    public function findItem(ProductModel $productModel)
    {
          $key = $productModel->getId_product();

          return $this->items[$key] ?? null;
    }

    /**
     * @return CartItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
