<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;


abstract class Model implements IModel
{

    public function __set($name, $value)
    {
        array_push($this->props, $name);
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