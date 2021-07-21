<?php


namespace app\models;


use app\core\Model;

class clientsModel extends Model
{

    public function getClients()
    {
        return $this->db->query("SELECT * FROM Clients");
    }

    public function getClient($id)
    {
        return $this->db->query("SELECT * FROM Clients WHERE Id = :id", ['id'=>$id]);
    }

    public function getOrders($id)
    {
        return $this->db->query("SELECT * FROM Orders WHERE ClientId = :id", ['id'=>$id]);
    }

    public function deleteClient($id)
    {
        return $this->db->query("DELETE FROM `Clients` WHERE `Id` = :id",['id'=>intval($id)]);
    }

    public function addClient($data)
    {
        $client = $this->db->query("INSERT INTO Clients (name, surname, phone, email, country, city, street, house, entrance, apartment)
            VALUES (:name, :surname, :phone, :email, :country, :city, :street, :house, :entrance, :apartment)", [
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => intval($data['name']) ,
            'email' => $data['name'],
            'country' => $data['name'],
            'city' => $data['name'],
            'street' => $data['name'],
            'house' => $data['name'],
            'entrance' => $data['name'],
            'apartment' => $data['name']
        ]);

        return $this->db->lastInsertId();
    }

    public function updateClient(array $data)
    {
        var_dump($data);
        return $this->db->query("UPDATE `Clients`
        SET `name` = :name, `surname` = :surname, `phone` = :phone, `email` = :email, `country` = :country, `city` = :city, `street` = :street, `house` =:house, `entrance` = :entrance, `apartment` =:apartment
        WHERE Id = :Id", [
            'Id' => intval($data['Id']),
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => intval($data['name']) ,
            'email' => $data['name'],
            'country' => $data['name'],
            'city' => $data['name'],
            'street' => $data['name'],
            'house' => $data['name'],
            'entrance' => $data['name'],
            'apartment' => $data['name']
        ]);
    }
}