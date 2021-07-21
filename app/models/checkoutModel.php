<?php


namespace app\models;


use app\core\libs\logger;
use app\core\Model;

class checkoutModel extends Model
{
    /**
     * Возвращает id пользователя
     * @param $email
     */
    public function getUser($userData)
    {
        //проверка существует ли пользователь
        //Если не сушествует то создаем и возвразаем id, если существует возвращаем id
        $email = $userData['email'];
        $userData['phone'] = intval($userData['phone']);
        $result = $this->db->query("SELECT id, email FROM Clients WHERE email = '$email'");
        if(empty($result))
        {
            $insert = $this->db->query("INSERT INTO Clients 
                   (`name`, `surname`, `phone`, `email`, `country`, `city`, `street`, `house`, `entrance`, `apartment`) 
            VALUES (:name, :surname, :phone, :email, :country, :city, :street, :house, :entrance, :apartment)", $userData);

            $userId = $this->db->lastInsertId();

            $logger = logger::getInstance();
            $logger->log(30, "Добавлен пользователь $userId");

            return $userId;
        } else{
            return $result[0]['id'];
        }
    }

    /**
     * Добавление заказа в БД
     * @param string $id
     * @param array $userData
     * @return bool
     */
    public function insertOrder(string $id, array $userData)
    {
        $insert = $this->db->query("INSERT INTO Orders 
                (`ClientId`, `DateCreated`, `Status`, `country`, `city`, `street`, `house`, `entrance`, `apartment`) 
        VALUES (:ClientId, :DateCreated, :Status, :country, :city, :street, :house, :entrance, :apartment)", [
            'ClientId' => $id,
            'DateCreated' => date("Y-m-d H:i:s"),
            'Status' => 1,
            'country' => $userData['country'],
            'city' => $userData['city'],
            'street' => $userData['street'],
            'house' => $userData['house'],
            'entrance' => $userData['entrance'],
            'apartment' => $userData['apartment'],
        ]);

        $orderId = $this->db->lastInsertId();
        foreach ($_SESSION['cart'] as $item=>$count)
        {
            $insert = $this->db->query("INSERT INTO Order_Item(`OrderId`, `ItemId`, `ItemCount`) 
        VALUES (:OrderId, :ItemId, :ItemCount)", [
                'OrderId' => $orderId,
                'ItemId' => $item,
                'ItemCount' => $count
            ]);
        }

        $logger = logger::getInstance();
        $logger->log(1, "Добавлен заказ", NULL, $orderId);

        return $orderId;
    }

    public function deleteOrder($id)
    {
        $logger = logger::getInstance();
        $logger->log(10, "Удален заказ", $id);
        return $this->db->query("DELETE FROM `Orders` WHERE `Id` = :id",['id'=>intval($id)]);
    }

    public function deleteItem($data)
    {
        $logger = logger::getInstance();
        $logger->log(9, "Удален товар", intval($data['Id'], intval($data['ItemId'])));
        return $this->db->query("DELETE FROM `Order_Item` WHERE `OrderId` = :id AND ItemId = :iId",
            [
                'id'=>intval($data['Id']),
                'iId' => intval($data['ItemId'])
            ]);
    }

    public function addItem($OrderId, $ItemId, $ItemCount)
    {
        $exsists =  $this->db->query("SELECT * FROM Order_Item WHERE OrderId = :OrderId AND ItemId = :ItemId",
            [
                'OrderId'=>intval($OrderId),
                'ItemId' => intval($ItemId),
            ]);

        if(empty($exsists))
        {
            $logger = logger::getInstance();
            $logger->log(8, "Добавлен товар", intval($OrderId), intval($ItemId));

            return $this->db->query("INSERT INTO `Order_Item` (OrderId, ItemId, ItemCount, Completed)
                                                        VALUES (:OrderId, :ItemId, :ItemCount, :Completed)",
                [
                    'OrderId'=>intval($OrderId),
                    'ItemId' => intval($ItemId),
                    'ItemCount' => intval($ItemCount),
                    'Completed' => false
                ]);
        }
        else{
            $logger = logger::getInstance();
            $logger->log(8, "Добавлен товар", intval($OrderId), intval($ItemId));

            $count =  $this->db->query("SELECT ItemCount FROM Order_Item WHERE OrderId = :OrderId AND ItemId = :ItemId",
                [
                    'OrderId'=>intval($OrderId),
                    'ItemId' => intval($ItemId),
                ]);

            return $this->db->query("UPDATE Order_Item SET ItemCount = :ItemCount WHERE OrderId = :OrderId AND ItemId = :ItemId",
                [
                    'OrderId'=>intval($OrderId),
                    'ItemId' => intval($ItemId),
                    'ItemCount' => intval($ItemCount) + $count[0]['ItemCount'],
                ]);
        }
    }
}