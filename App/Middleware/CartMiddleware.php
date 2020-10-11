<?php


namespace App\Middleware;


use App\Data\Cart\Cart;
use App\DI\Container;

class CartMiddleware implements IMiddleware
{
    /**
     * @var Container
     */
    private $di;

    /**
     * @var Cart
     */
    private $cart;

    public function __construct(Container $di)
    {
        $this->di = $di;

        $cartSerializeData = $_SESSION['cart'] ?? null;
        $cart = null;

        if (!is_null($cartSerializeData)) {
            $cart = unserialize($cartSerializeData);
        }

        if (!($cart instanceof Cart)) {
            $cart = new Cart();
        }

        $this->cart = $cart;
        $di->addOneMapping(Cart::class, $cart);
    }

    public function beforeDispatch()
    {

    }

    public function afterDispatch()
    {
        $_SESSION['cart'] = serialize($this->cart);
    }
}