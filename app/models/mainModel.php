<?php


namespace app\models;


use app\core\Model;

class mainModel extends Model
{
    public function getAllGoods()
    {
        $query = $this->db->query('SELECT * FROM Items');

        $this->db->disconnect();

        return $query;
    }
}