<?php


namespace app\core;

use app\core\libs\db\db;

class Model
{
    public $db;

    public function __construct()
    {
        $db_settings = require 'app/core/libs/db/db_config.php';
        $this->db = new db($db_settings['db']);
    }
}