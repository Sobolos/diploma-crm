<?php


namespace app\core\libs\menu;


class menu
{
    public static function render()
    {
        if($_SESSION['user']['role'] === 1)
            include 'views/adminView.php';
        if($_SESSION['user']['role'] === 2)
            include 'views/userView.php';
        if($_SESSION['user']['role'] === 3)
            include 'views/manufacturerView.php';
    }
}