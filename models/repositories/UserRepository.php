<?php
namespace app\models\repositories;

use app\models\entities\User;
use \app\models\Repository;

class UserRepository extends Repository
{

    protected function getEntityClass()
    {
        return User::class;
    }

    public function auth($login, $pass)
    {

        $user =  $this->getOneWhere('email', $login);

        //password_verify('123', $hash);
        if (password_verify($pass, $user->password_hash)) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;

    }

    public  function isAuth()
    {
        return isset($_SESSION['login']);
    }

    public  function isAdmin()
    {
        return $_SESSION['login'] == 'admin';
    }

    public  function getName()
    {
        return $_SESSION['login'];
    }

    public function getTableName()
    {
        return 'users';
    }
}