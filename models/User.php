<?php

namespace app\models;

class User extends DBModel
{
    protected $id;
    protected  $name;
    protected  $surname;
    protected  $email;
    protected  $password_hash;

    protected $props = [];

    public function __construct( $name = null,
                                 $surname = null,
                                 $email = null,
                                 $password_hash = null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password_hash = $password_hash;
    }


    public static function getTableName()
    {
        return 'users';
    }
}