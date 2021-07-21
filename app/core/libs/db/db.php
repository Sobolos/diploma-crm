<?php


namespace app\core\libs\db;

use PDO;
use PDOException;
use PDOStatement;

class db
{
    /**
     * Объект PDO
     * @var PDO
     */
    private $PDO;

    /**
     * Есть подключение к БД или нет
     * @var bool
     */
    private $isConnected;
    /**
     * PDO выражение
     * @var PDOStatement
     */
    private $statement;

    /**
     * Настройки базы данных
     * @var array
     */
    private $settings;

    /**
     * Параметры SQL запроса
     * @var array
     */
    private $params = [];

    public function __construct(array $settings)
    {
        $this->settings = $settings;

        $this->connect();
    }

    /**
     * Подключение к БД
     */
    private function connect()
    {
        $dsn = 'mysql:dbname='.$this->settings['dbname'].';host='.$this->settings['host'];

        try{
            $this->PDO = new PDO($dsn, $this->settings['user'], $this->settings['password'],[
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$this->settings['charset']
            ]);

            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->isConnected = true;
        }catch (PDOException $e){
            exit($e->getMessage());
        }
    }

    public function disconnect()
    {
        $this->PDO = null;
        $this->isConnected = false;
    }

    private function init(string $query, array $parameters = [])
    {
        if (!$this->isConnected)
            $this->connect();

        try{
            #Подготовка запроса
            $this->statement = $this->PDO->prepare($query);
            $this->bind($parameters);

            if(!empty($this->params)){
                foreach ($this->params as $param => $value){
                    if (is_int($value[1])) {
                        $type = PDO::PARAM_INT;
                    } elseif (is_bool($value[1])) {
                        $type = PDO::PARAM_BOOL;
                    } elseif (is_null($value[1])) {
                        $type = PDO::PARAM_NULL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }

                    $this->statement->bindValue($value[0], $value[1], $type);
                }
            }

            $this->statement->execute();

        }catch (PDOException $e){
            exit($e->getMessage());
        }

        $this->params = [];
    }

    /**
     * @return void
     * @param array $parameters
     */
    private function bind(array $parameters) : void
    {
        if(!empty($parameters) && is_array($parameters))
        {
            $cols = array_keys($parameters);

            foreach ($cols as $i => $col)
            {
                $this->params[sizeof($this->params)] = [
                    ':'.$col,
                    $parameters[$col]
                ];
            }
        }
    }

    /**
     * @param string $query
     * @param array $parameters
     * @param int $mode
     * @return array|int|null
     */
    public function query(string $query, array $parameters = [], $mode = \PDO::FETCH_ASSOC)
    {
        $query = trim(str_replace('\r', ' ', $query));
        $this->init($query, $parameters);
        $rawStatement = explode(' ', preg_replace("/\s+|\t+|\n+/", " ", $query));
        $statement = strtolower($rawStatement[0]);

        if($statement === 'select' || $statement === 'show'){
            return $this->statement->fetchAll($mode);
        }
        elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete')
            return $this->statement->rowCount();
        else return null;
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->PDO->lastInsertId();
    }
}