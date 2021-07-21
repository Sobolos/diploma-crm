<?php


namespace app\models;


use app\core\libs\logger;
use app\core\Model;

class manufacturerModel extends Model
{
    public function getOrders()
    {
        return $this->db->query("
            SELECT Manufacturing.Id, Manufacturing.ItemCompleted, Users.name FROM Manufacturing 
            INNER JOIN Users on Users.Id = Manufacturing.dealerId ");
    }

    public function getOrder($id)
    {
        return $this->db->query("
		SELECT * FROM Manuf_Item mi 
        INNER JOIN Manufacturing on mi.manufacturingId = Manufacturing.Id
        INNER JOIN Items on mi.ItemId = Items.Id
        INNER JOIN Users on Manufacturing.dealerId = Users.Id
        WHERE mi.manufacturingId = $id");
    }

    public function takeInWork($userId, $orderId)
    {
        $logger = logger::getInstance();
        $logger->log(4, "Заказ принят на производство", $userId);
        $manufacurig = $this->db->query("UPDATE `Manufacturing` SET `manufacturer` = $userId WHERE `id` = $orderId");
    }

    public function completeManufacturingItem($id, $itemCount, $itemId)
    {
        $itemIncrease = $this->db->query("UPDATE `Items` SET `Count` = (Items.Count+$itemCount)
                                                WHERE `Id` = $itemId");

        $completed = $this->db->query("UPDATE `Manufacturing` SET `ItemCompleted` = true 
                                                WHERE `id` = $id AND `itemId` = $itemId");

        return $completed && $itemIncrease;
    }

    public function finishManufacturingOrder($id, $dealerId)
    {
        $logger = logger::getInstance();
        $logger->log(5, "Заказ отправлен дилеру");

        $responsible = $this->db->query("UPDATE `Orders` SET `Status` = 5, `responsible` = $dealerId WHERE `Id` = $id");
    }

    public function getmanufacturers()
    {
        return $this->db->query('SELECT * FROM Users WHERE `role` = :role', ['role' => 3]);
    }

    public function deleteManufacturer($id)
    {
        return $this->db->query("DELETE FROM `Users` WHERE `id` = $id");
    }

    public function addManufacturer($name, $pass)
    {
        $pass_hash = md5($pass);
        return $this->db->query("INSERT INTO `Users` (`name`, `role`, `password`) VALUES (:name, :role, :password)", [
            'name' => $name,
            'role' => 3,
            'password' => $pass_hash
        ]);
    }
}