<?php

namespace app\models\entities;

use app\models\Entity;

class User extends Entity
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
}