<?php


namespace app\core;


class Router
{
    public function start()
    {
        $controller = 'main';
        $action = 'index';

        // получаем url-адрес
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя котроллера
        if (!empty($routes[1]) )
        {
            $controller = explode('?', $routes[1])[0];
        }

        // получаем имя экшена
        if (!empty($routes[2]) )
        {
            $action = explode('?', $routes[2])[0];
        }

        $controller = $controller.'Controller';
        $action = $action.'Action';

        $controller_path = "app/controllers/".$controller.".php";
        $controller_name = "app\controllers\\".$controller;
        if(file_exists($controller_path))
            include $controller_path;
        else self::ErrorPage404();

        if(class_exists($controller_name))
            $controller_obj = new $controller_name;
        else self::ErrorPage404();

        if(method_exists($controller_obj, $action))
            $controller_obj->$action();
        else
            self::ErrorPage404();
    }

    private static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404.php');
    }
}