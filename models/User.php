<?php

namespace app\models;

class User extends Model
{
    public $id;
    public  $name;
    public  $surname;
    public  $email;
    public  $password_hash;


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