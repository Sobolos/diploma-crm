<?php


namespace app\models;


use app\core\Model;

class loginModel extends Model
{
    public function login($data)
    {
        $name = $data['login'];
        $pass_hash = md5($data['password']);
        $user = $this->db->query("SELECT `id`, `name`, `role`, `password` FROM `Users` WHERE `name` = '$name'");

        if($user[0]['password'] === $pass_hash)
        {
            $_SESSION['user']['id'] = $user[0]['id'];
            $_SESSION['user']['role'] = $user[0]['role'];
            return true;
        }else{
            return false;
        }
    }
    public function logout()
    {
        session_destroy();
    }
}