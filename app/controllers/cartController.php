<?php


namespace app\controllers;


use app\core\Controller;
use app\models\cartModel;
use app\models\checkoutModel;

class cartController extends Controller
{
    public function indexAction()
    {
        $model = new cartModel();
        $cart = $model->getProductsFromSession(); //тут получаем из сессии корзину

        /**
         * если товары есть, формируем массив
         */
        if($cart){
            $productsIds = array_keys($cart);
            $products = $model->getProducts($productsIds);
            $totalPrice = $model->getTotalPrice($cart);
        }
        else{
            $productsIds = [];
            $products = [];
            $totalPrice = 0;
        }

        $this->view->generate('cartView.php', 'main.tpl.php', ['title'=>'Корзина',
            'goods'=>$products, 'totalPrice'=>$totalPrice]);

    }

    /**
     * Добавление товара в корзину
     */
    public function addAction()
    {
        $model = new cartModel();
        $id = $_POST['id'];
        $count = $_POST['count'];
        echo $model->addToCart($id, $count);
    }

    /**
     * Отображение оформления заказа
     */
    public function checkoutAction()
    {
        $this->view->generate('checkoutView.php', 'main.tpl.php', ['title'=>'Офрмление заказа']);
    }

    /**
     * Сохранение заказа
     */
    public function saveorderAction()
    {
        $model = new checkoutModel();
        $userData = $_POST;

        $id = $model->getUser($userData);
        $orderID = $model->insertOrder($id, $userData);

        unset($_SESSION['cart']);

        echo $orderID;
    }
}