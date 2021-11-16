<?php

namespace app\models;

use app\engine\Db;


abstract class Entity
{

    public function __set($name, $value)
    {
//        if (!is_null($value) | !empty($value)) {
        array_push($this->props, $name);
//        }

        $this->$name = $value;
    }


    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }
}