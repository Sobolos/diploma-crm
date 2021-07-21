<?php


namespace app\models;


use app\core\libs\logger;
use app\core\Model;

class dealerModel extends Model
{
    public function getNewOrders()
    {
        return $this->db->query("
        SELECT Orders.Id, Orders.DateCreated, Clients.name client_name, Clients.surname client_surname FROM Orders
        INNER JOIN Clients on Clients.Id = Orders.ClientId 
        WHERE Orders.Status = 1
        limit 5");
    }

    public function getOrders_MainPage($userId, $status)
    {
        return $this->db->query("
        SELECT Orders.Id, Orders.responsible, Orders.DateCreated, Clients.name client_name, Clients.surname client_surname, Manufacturing.manufacturer, Users.name FROM Orders
        INNER JOIN Clients on Clients.Id = Orders.ClientId 
        INNER JOIN `Manufacturing` on Manufacturing.orderId = Orders.Id
        INNER JOIN Users on Users.id = Manufacturing.manufacturer
        WHERE Orders.Status = $status AND Orders.responsible = $userId
        limit 5");
    }

    public function getOrder($id)
    {
        return $this->db->query("
        SELECT * FROM Order_Item oi 
        INNER JOIN Orders on oi.OrderId = Orders.Id
        INNER JOIN Items on oi.ItemId = Items.Id
        INNER JOIN Clients on Orders.ClientId = Clients.Id
        WHERE oi.OrderId = '$id'");
    }

    public function getOrders($id)
    {
        return $this->db->query("
        SELECT Orders.Id, Orders.Status, Orders.DateCreated, Clients.name client_name, Clients.surname client_surname 
        FROM Orders 
        INNER JOIN Clients on Clients.Id = Orders.ClientId
        WHERE `Orders`.Status = 1 OR `Orders`.responsible = '$id'");
    }

    /**
     * Взять заказ в работу
     * @param $id
     * @param $orderId
     * @return array|int|null
     */
    public function takeInWork($id, $orderId)
    {
        $logger = logger::getInstance();
        $logger->log(2, "Заказ принят дилером", $_SESSION['user']['id'], $orderId);
        return $this->db->query("UPDATE `Orders` SET `Status` = 2, `responsible` = $id WHERE `Id` = $orderId");
    }

    public function completeOrderItem($id, $itemCount, $itemId)
    {
        $logger = logger::getInstance();
        $logger->log(11, "Товар укомплектован", $_SESSION['user']['id'], $id, $itemId);

        $completed = $this->db->query("UPDATE `Order_Item` SET `Completed` = true 
                                                WHERE `OrderId` = $id AND `ItemId` = $itemId");

        $itemSubtract = $this->db->query("UPDATE `Items` SET `Count` = (Items.Count-$itemCount)
                                                WHERE `Id` = $itemId");

        return $completed && $itemSubtract;
    }

    public function makeOrderItem($dealerId, $itemCount, $itemId, $orderId)
    {
        $manufacturing = $this->db->query("
        INSERT INTO Manufacturing (`itemId`, `count`, `dealerId`, `orderId`) 
                            VALUES (:ItemId, :itemCount, :dealerId, :orderId)", [
            'ItemId' => $itemId,
            'itemCount' => $itemCount,
            'dealerId' => $dealerId,
            'orderId' => $orderId
        ]);

        $manufacturingId = $this->db->lastInsertId();

        $manuf_item = $this->db->query("INSERT INTO Manuf_Item(`manufacturingId`, `ItemId`) 
        VALUES (:manufacturingId, :ItemId)", [
            'manufacturingId' => $manufacturingId,
            'ItemId' => $itemId,
        ]);

        $logger = logger::getInstance();
        $logger->log(3, "Заказ на производство $itemCount едениц отправлен производителю", $dealerId, $orderId, $itemId);

        return true;
    }

    public function completeOrder($orderId)
    {
        $logger = logger::getInstance();
        $logger->log(6, "Заказ укомплектован", $_SESSION['user']['id'], $orderId);
        return $this->db->query("UPDATE `Orders` SET `Status` = 6 WHERE `Id` = $orderId");
    }

    public function finishOrder($orderId)
    {
        $logger = logger::getInstance();
        $logger->log(7, "Заказ выдан",  $_SESSION['user']['id'], $orderId);
        return $this->db->query("UPDATE `Orders` SET `Status` = 7 WHERE `Id` = $orderId");
    }

    public function getDealers()
    {
        return $this->db->query('SELECT * FROM Users WHERE `role` = :role', ['role' => 2]);
    }

    public function deleteDealers($id)
    {
        return $this->db->query("DELETE FROM `Users` WHERE `id` = $id");
    }

    public function addDealers($name, $pass)
    {
        $pass_hash = md5($pass);
        return $this->db->query("INSERT INTO `Users` (`name`, `role`, `password`) VALUES (:name, :role, :password)", [
            'name' => $name,
            'role' => 2,
            'password' => $pass_hash
        ]);
    }
}