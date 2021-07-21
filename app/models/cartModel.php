<?php


namespace app\models;


use app\core\Model;

class cartModel extends Model
{
    /**
     * Добавление товара в корзину
     * @param $id - id элемента
     * @param int $count - количество элементов
     * @return int|mixed
     */
    public function addToCart($id, $count = 1)
    {
        $id = intval(trim(htmlspecialchars($id)));
        $count = intval(trim(htmlspecialchars($count)));
        $cart = [];
        if(isset($_SESSION['cart']))
            $cart = $_SESSION['cart'];

        //если товар уже есть, то увеличить его количество
        if(array_key_exists($id, $cart))
            $cart[$id] = $cart[$id] + $count;
        else
            $cart[$id] = $count;

        $_SESSION['cart'] = $cart;

        return self::countItems();
    }

    /**
     * Подсчет товара в корзине
     * @return int|mixed
     */
    public static function countItems()
    {
        if(isset($_SESSION['cart'])){
            $count = 0;
            foreach ($_SESSION['cart'] as $id => $quantity)
                $count = $count + $quantity;

            return $count;
        }else return 0;
    }

    /**
     * Получение корзины
     * @return int|mixed
     */
    public function getProductsFromSession()
    {
        if(isset($_SESSION['cart']))
            return $_SESSION['cart'];
        else return false;
    }

    /**
     * Получение информации о продуктах
     * @return int|mixed
     */
    public function getProducts($ids)
    {
        $ids = implode(',', $ids);

        return $this->db->query("SELECT * FROM Items WHERE Id IN ($ids)");
    }

    /**
     * Получение окончательной цены
     * @return float|int
     */
    public function getTotalPrice($productsSession)
    {
        $totalPrice = 0;

        $productsIds = array_keys($productsSession);
        $products = self::getProducts($productsIds);

        if($products)
        {
            $i =0;
            foreach ($products as $item){
                $totalPrice += $item['Price'] * $productsSession[$item['Id']];
                $i++;
            }
        }
        return $totalPrice;
    }
}