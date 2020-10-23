<?php


namespace App\Data\Shop\Order;


use App\Controller\AbstractController;
use App\Data\Product\ProductRepositoryOld;
use App\Data\User\UserModel;
use App\Model\ModelManager;

class OrderController extends AbstractController
{
    /**
     * @route("/order/list")
     */
    public function index()
    {
        return $this->render('shop/order/index.tpl', []);
    }

    /**
     * @route("/order/view/{id}")
     */
    public function view(int $id)
    {
        return $this->render("/order/view.tpl");
    }

    /**
     * @route("/order/create")
     */
    public function create(ModelManager $manager, ProductRepositoryOld $productRepository, UserModel $user = null)
    {

        $productsForOrder = [
            [21, 1],
            [22, 2],
            [24, 1]
        ];

        $order = new OrderModel();

        foreach ($productsForOrder as $info) {
            list($productId, $amount) = $info;
            $product = $productRepository->getById($productId);

            $orderItem = new OrderItemModel($amount, $product, $order);
            $order->addItem($orderItem);

        }

        if (!is_null($user)) {
            $order->setUser($user);
        }
//      dump($order); exit;
        $manager->save($order);
 //      dump($order->getProductData()); exit;
        foreach ($order->getProductData() as $item) {

//            dump($item); exit;
            $manager->save($item);
        }



        return $this->redirect("/order/list");
    }

    /**
     * @route("/order/update")
     */
    public function update(OrderRepository $orderRepository)
    {

        $order = $orderRepository->find(115);
        dump($order); exit;

//        $productsForOrder = [
//            [21, 1],
//            [22, 2],
//            [24, 1]
//        ];
//
//        $order = new OrderModel();
//
//        foreach ($productsForOrder as $info) {
//            list($productId, $amount) = $info;
//            $product = $productRepository->getById($productId);
//
//            $orderItem = new OrderItemModel($amount, $product, $order);
//            $order->addItem($orderItem);
//
//        }
//
//        if (!is_null($user)) {
//            $order->setUser($user);
//        }
//        //      dump($order); exit;
//        $manager->save($order);
//        //      dump($order->getProductData()); exit;
//        foreach ($order->getProductData() as $item) {
//
////            dump($item); exit;
//            $manager->save($item);
//        }



        return $this->redirect("/order/list");
    }



    /**
     * @route("/order/delete")
     */
    public function delete()
    {
        return $this->redirect("/order/list");
    }
}