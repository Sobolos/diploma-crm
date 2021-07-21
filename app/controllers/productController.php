<?php


namespace app\controllers;


use app\core\Controller;
use app\models\productModel;


class productController extends Controller
{
    public function indexAction()
    {
        $model = new productModel();
        $good = $model->getGood();

        $this->view->generate('productView.php', 'main.tpl.php', ['title'=>'Просмотр товара',
            'good'=>$good[0]]);
    }

    public function trackAction()
    {
        $model = new productModel();

        $this->view->generate('trackorder.php', 'main.tpl.php', [
            'title'=>'Трэкинг товара',
        ]);
    }
}