<?php


namespace App\Data\Cart;


use App\Controller\AbstractController;
use App\Data\Product\ProductRepository;
use App\Http\Response;

class CartController extends AbstractController
{
    /**
     * @route("/shop/cart")
     */
    public function index(Cart $cart, ProductRepository $productRepository)
    {
//        $cart = new Cart();
//
//        $product = $productRepository->getById(4);
//        $amount = 2;
//
//        $cart->addProduct($amount, $product);
//   //     echo "<pre>"; var_dump($cart); echo "</pre>"; exit;


        return $this->render('cart/index.tpl', [
            'cart' => $cart,
        ]);
    }

    /**
     * @route("/shop/cart/add")
     *
     * @param Cart $cart
     * @param ProductRepository $productRepository
     * @return Response
     * @throws \Exception
     */
    public function addProduct(Cart $cart, ProductRepository $productRepository)
    {
        $id = $this->request->getIntFromGet('id_product');
 //       echo "<pre>"; var_dump($id); echo "</pre>"; exit;
        $amount = $this->request->getIntFromGet('amount', 1);

        if ($id) {
            $product = $productRepository->getById($id);
            $cart->addProduct($amount, $product);


  //          $_SESSION['cart'] = serialize($cart);
        }

        return $this->redirect('/shop/cart');
    }

    /**
     * @route("/shop/cart/remove")
     *
     * @param Cart $cart
     * @param ProductRepository $productRepository
     * @return Response
     * @throws \Exception
     */
    public function removeProduct(Cart $cart, ProductRepository $productRepository)
    {
        $id = $this->request->getIntFromGet('id_product');

        if ($id) {
            $product = $productRepository->getById($id);
            $cart->removeProduct($product);


 //           $_SESSION['cart'] = serialize($cart);
        }

        return $this->redirect('/shop/cart');
    }

}