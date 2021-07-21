<?php


namespace app\models;


use app\core\Model;

class productModel extends Model
{
    public function getGood()
    {
        $query = $this->db->query('SELECT * FROM Items WHERE Id = :id', ['id' => $_GET['id']]);

        $this->db->disconnect();

        return $query;
    }

    public function updateItem($data)
    {
        if (!empty($_POST['OnSale'])) {
            if ($data['OnSale'] === "1")
                $data['OnSale'] = true;
        } else {
            $data['OnSale'] = false;
        }
        return $this->db->query("UPDATE `Items`
        SET `Name` = :name, `Price` = :price, `Description` = :desc, `OnSale` = :onsale, `SalePercent` = :salepercent
        WHERE Id = :Id", [
            'name' => $data['Name'],
            'price' => intval($data['Price']),
            'desc' => $data['Description'],
            'onsale' => $data['OnSale'],
            'salepercent' => intval($data['SalePercent']),
            'Id' => $data['Id']
        ]);
    }

    public function deleteItem($id)
    {
        return $this->db->query("DELETE FROM `Items` WHERE `Id` = $id");
    }
}