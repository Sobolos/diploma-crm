<?php


namespace app\controllers;


use app\core\Controller;
use app\models\adminModel;
use app\models\checkoutModel;
use app\models\clientsModel;
use app\models\dealerModel;
use app\models\loginModel;
use app\models\manufacturerModel;
use app\models\productModel;

class adminController extends Controller
{
    public function loginAction()
    {
        if(array_key_exists('user', $_SESSION))
            header('Location: /admin');
        else
            $this->view->generate('loginView.php', 'main.tpl.php', ['title'=>'Вход']);
    }

    public function logoutAction()
    {
        $model = new loginModel();

        if(array_key_exists('user', $_SESSION)){
            $model->logout();
            header('Location: /admin/login');
        }
        else
            $this->view->generate('loginView.php', 'main.tpl.php', ['title'=>'Вход']);
    }

    public function loginformAction()
    {
        $data = $_POST;
        $model = new loginModel();
        if($model->login($data))
            header('Location: /admin/login');
        else
            header('Location: /');
    }

    public function indexAction()
    {
        if($_SESSION['user']['role'] === 2)
        {
            $model = new dealerModel();
            $newOrder = $model->getNewOrders();
            $sentOrder = $model->getOrders_MainPage($_SESSION['user']['id'], 2);
            $gottenOrder = $model->getOrders_MainPage($_SESSION['user']['id'], 5);
            if(array_key_exists('user', $_SESSION)){
                $this->view->generate('dealerView.php', 'admin.tpl.php', [
                    'title'=>'Главная',
                    'newOrders' => $newOrder,
                    'sentOrders' => $sentOrder,
                    'gottenOrders' => $gottenOrder,
                ]);
            }
            else
                header('Location: /admin/login');
        }
        elseif ($_SESSION['user']['role'] === 3)
        {
            $model = new manufacturerModel();
            $orders = $model->getOrders();
            if(array_key_exists('user', $_SESSION)){
                $this->view->generate('manufacturerView.php', 'admin.tpl.php', [
                    'title'=>'Главная',
                    'orders' => $orders,
                ]);
            }
            else
                header('Location: /admin/login');
        }
        elseif ($_SESSION['user']['role'] === 1)
        {
            $model = new adminModel();
            $log = $model->getOperations();
            if(array_key_exists('user', $_SESSION)){
                $this->view->generate('adminView.php', 'admin.tpl.php', [
                    'title'=>'Главная',
                    'log' => $log,
                ]);
            }
            else
                header('Location: /admin/login');
        }
    }

    public function ordersAction()
    {
        if($_SESSION['user']['role'] === 2) {
            $model = new dealerModel();
            $orders = $model->getOrders($_SESSION['user']['id']);
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('ordersView.php', 'admin.tpl.php', [
                    'title' => 'Главная',
                    'orders' => $orders,
                ]);
            } else
                header('Location: /admin/login');
        }
        elseif ($_SESSION['user']['role'] === 1)
        {
            $model = new adminModel();
            $orders = $model->getOrders();
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('ordersView.php', 'admin.tpl.php', [
                    'title' => 'Заказы',
                    'orders' => $orders,
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function orderAction()
    {
        if($_SESSION['user']['role'] === 1){
            $model = new dealerModel();
            $order = $model->getOrder($_GET['id']);
            if(array_key_exists('user', $_SESSION)){
                $this->view->generate('adminorderView.php', 'admin.tpl.php', [
                    'title'=>'Главная',
                    'order' => $order,
                ]);
            }
            else
                header('Location: /admin/login');
        }
        if($_SESSION['user']['role'] === 2){
            $model = new dealerModel();
            $order = $model->getOrder($_GET['id']);
            if(array_key_exists('user', $_SESSION)){
                $this->view->generate('orderView.php', 'admin.tpl.php', [
                    'title'=>'Главная',
                    'order' => $order,
                ]);
            }
            else
                header('Location: /admin/login');
        }
        elseif ($_SESSION['user']['role'] === 3)
        {
            $model = new manufacturerModel();
            $order = $model->getOrder($_GET['id']);
            if(array_key_exists('user', $_SESSION)){
                $this->view->generate('manufacturerorderView.php', 'admin.tpl.php', [
                    'title'=>'Главная',
                    'order' => $order,
                ]);
            }
            else
                header('Location: /admin/login');
        }


    }

    public function takeinworkAction()
    {
        $orderId = $_POST['orderId'];
        $userId = $_SESSION['user']['id'];
        if($_SESSION['user']['role'] === 2)
        {
            $model = new dealerModel();
        }
        else if($_SESSION['user']['role'] === 3){
            $model = new manufacturerModel();
        }
        $model->takeInWork($userId, $orderId);
    }

    public function completeorderitemAction()
    {
        $id = $_POST['orderId'];
        $itemCount = $_POST['itemCount'];
        $itemId = $_POST['itemId'];
        $model = new dealerModel();
        $model->completeOrderItem($id, $itemCount, $itemId);
        return true;
    }

    public function makeorderitemAction()
    {
        $dealerId = $_SESSION['user']['id'];
        $itemCount = $_POST['itemCount'];
        $itemId = $_POST['itemId'];
        $orderId = $_POST['orderId'];
        $model = new dealerModel();
        $model->makeOrderItem($dealerId, $itemCount, $itemId, $orderId);
    }

    public function completemanufacturingitemAction()
    {
        print_r($_POST);
        $id = $_POST['orderId'];
        $itemCount = $_POST['itemCount'];
        $itemId = $_POST['itemId'];
        $model = new manufacturerModel();
        $model->completeManufacturingItem($id, $itemCount, $itemId);
    }

    public function finishmanufacturingorderAction()
    {
        $id = $_POST['orderId'];
        $dealerId = $_POST['dealerId'];
        $model = new manufacturerModel();
        $model->finishManufacturingOrder($id, $dealerId);
    }

    public function completeorderAction()
    {
        $orderId = $_POST['orderId'];
        $model = new dealerModel();
        $model->completeOrder($orderId);
    }

    public function finishorderAction()
    {
        $orderId = $_POST['orderId'];
        $model = new dealerModel();
        $model->finishOrder($orderId);
    }

    public function itemsAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
        $model = new adminModel();
            $items = $model->getItems();
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('itemsView.php', 'admin.tpl.php', [
                    'title' => 'Товары',
                    'items' => $items,
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function itemAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new productModel();
            $item = $model->getGood();
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('itemView.php', 'admin.tpl.php', [
                    'title' => 'Товар',
                    'item' => $item[0],
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function updateitemAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new productModel();
            $item = $model->updateItem($_POST);
            $id=$_POST['Id'];
            header("Location: /admin/item?id=$id");
        }
    }

    public function deleteitemAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $id = $_POST['Id'];
            $model = new productModel();
            $item = $model->deleteItem($id);
            header("Location: /admin/items");
        }
    }

    public function manufacturersAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new manufacturerModel();
            $manufacturers = $model->getmanufacturers();
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('manufacturersView.php', 'admin.tpl.php', [
                    'title' => 'Производители',
                    'manufacturers' => $manufacturers,
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function deletemanufacturerAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $id = $_POST['Id'];
            $model = new manufacturerModel();
            $item = $model->deleteManufacturer($id);
            header("Location: /admin/manufacturers");
        }
    }

    public function addmanufacturerAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $name = $_POST['Name'];
            $pass = $_POST['Pass'];
            $model = new manufacturerModel();
            $item = $model->addManufacturer($name, $pass);
            header("Location: /admin/manufacturers");
        }
    }

    public function dealersAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new dealerModel();
            $dealers = $model->getDealers();
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('dealersView.php', 'admin.tpl.php', [
                    'title' => 'Производители',
                    'dealers' => $dealers,
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function deletedealersAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $id = $_POST['Id'];
            $model = new dealerModel();
            $item = $model->deleteDealers($id);
            header("Location: /admin/dealers");
        }
    }

    public function adddealersAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $name = $_POST['Name'];
            $pass = $_POST['Pass'];
            $model = new dealerModel();
            $item = $model->addDealers($name, $pass);
            header("Location: /admin/dealers");
        }
    }

    public function clientsAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new clientsModel();
            $clients = $model->getClients();
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('clientsView.php', 'admin.tpl.php', [
                    'title' => 'Клиенты',
                    'clients' => $clients,
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function searchclientsAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new clientsModel();
            $clients = $model->getClient($_POST['Id']);
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('clientsView.php', 'admin.tpl.php', [
                    'title' => 'Клиенты',
                    'clients' => $clients,
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function clientAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new clientsModel();
            $client = $model->getClient($_GET['id']);
            $orders = $model->getOrders($client[0]['Id']);
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('clientView.php', 'admin.tpl.php', [
                    'title' => 'Клиенты',
                    'clients' => $client,
                    'orders' => $orders
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function updateclientAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new clientsModel();
            $client = $model->updateClient($_POST);
            header("Location: /admin/clients");
        }
    }

    public function deleteclientAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new clientsModel();
            $item = $model->deleteClient($_POST['Id']);
            header("Location: /admin/clients");
        }
    }

    public function addclientAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            if (array_key_exists('user', $_SESSION)) {
                $this->view->generate('addclientView.php', 'admin.tpl.php', [
                    'title' => 'Добавить клиента',
                ]);
            } else
                header('Location: /admin/login');
        }
    }

    public function addclientformAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new clientsModel();
            $client = $model->addClient($_POST);
            header("Location: /admin/client?id=$client");
        }
    }

    public function deleteorderAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new checkoutModel();
            $order = $model->deleteOrder($_POST['Id']);
            header("Location: /admin/orders");
        }
    }

    public function deleteorderitemAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $id = $_POST['Id'];
            $model = new checkoutModel();
            $order = $model->deleteItem($_POST);
            header("Location: /admin/order?id=$id");
        }
    }

    public function addorderitemAction()
    {
        if ($_SESSION['user']['role'] === 1)
        {
            $model = new checkoutModel();
            $OrderId = $_POST['orderId'];
            $ItemId = $_POST['itemId'];
            $ItemCount = $_POST['count'];
            $order = $model->addItem($OrderId, $ItemId, $ItemCount);
            header("Location: /admin/order?id=$OrderId");
        }
    }

    public function searchordersAction()
    {
        $model = new adminModel();
        $orders = $model->searchOrders($_POST['Id']);
        if (array_key_exists('user', $_SESSION)) {
            $this->view->generate('searchordersView.php', 'admin.tpl.php', [
                'title' => 'Заказы',
                'orders' => $orders,
            ]);
        }
    }
}