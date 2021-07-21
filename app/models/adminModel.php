<?php


namespace app\models;


use app\core\Model;

class adminModel extends Model
{

    public function getOperations()
    {
        return $this->db->query('SELECT `Users`.name, Log.* FROM Log LEFT JOIN Users ON Users.id = Log.initiator ORDER BY Log.`Date` DESC');
    }

    public function getOrders()
    {
        return $this->db->query("
        SELECT Orders.Id, Orders.Status, Orders.DateCreated, Clients.name client_name, Clients.surname client_surname 
        FROM Orders 
        INNER JOIN Clients on Clients.Id = Orders.ClientId");
    }

    public function getItems()
    {
        return $this->db->query("SELECT * FROM Items");
    }

    public function searchOrders($id)
    {
        return $this->db->query("
        SELECT Orders.Id, Orders.Status, Orders.DateCreated, Clients.name client_name, Clients.surname client_surname 
        FROM Orders 
        INNER JOIN Clients on Clients.Id = Orders.ClientId
        WHERE Orders.`Id` LIKE $id");
    }
}