<?php


namespace app\core\libs;


use app\core\Model;

class logger extends Model
{
    private static $instances = [];

    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static;
        }
        return self::$instances[$subclass];
    }

    /**
     * Тип
     * Сообщение
     * Инициатор
     * id заказа
     * id товара
     * @param $type
     * @param $message
     * @param $initiator
     * @param null $orderId
     * @param null $itemId
     */
    public function log($type, $message, $initiator = NULL, $orderId = NULL, $itemId = NULL)
    {
        echo $initiator."\n";
        $this->db->query("INSERT INTO Log (type, Date, message, initiator, OrderId, ItemId)
        VALUES (:type, :Date, :message, :initiator, :orderId, :itemId)", [
            'type' => $type,
            'Date' => date("Y-m-d H:i:s"),
            'message' => $message,
            'initiator' => $initiator,
            'orderId' => $orderId,
            'itemId' => $itemId
        ]);
    }
}