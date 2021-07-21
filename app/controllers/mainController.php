<?php


namespace app\controllers;


use app\core\Controller;
use app\models\mainModel;

class mainController extends Controller
{
    public function indexAction()
    {
        $model = new mainModel();
        $goods = $model->getAllGoods();

        $this->view->generate('mainView.php', 'main.tpl.php', ['title'=>'Главная', 'goods'=>$goods]);
    }
}