<?php

namespace app\models;

class User extends DBModel
{
    protected $id;
    protected $name;
    protected $surname;
    protected $email;
    protected $password_hash;

    protected $props = [
        'login' => false,
        'pass' => false
    ];

    public function __construct($name = null,
                                $surname = null,
                                $login = null,
                                $password_hash = null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $login;
        $this->password_hash = $password_hash;
    }

    public static function auth($login, $pass)
    {

        //TODO проверить user на false
        $user = User::getOneWhere('email', $login);

        //TODO захешируйте пароль

        //password_verify('123', $hash);
        if (password_verify($pass, $user->password_hash)) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;

    }

    public static function isAuth()
    {
        return isset($_SESSION['login']);
    }

    public static function isAdmin()
    {
        return $_SESSION['login'] == 'admin';
    }

    public static function getName()
    {
        return $_SESSION['login'];
    }

    public static function getTableName()
    {
        return 'users';
    }
}