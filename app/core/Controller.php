<?php


namespace app\core;

class Controller
{
    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    public function indexAction()
    {
    }
}