<?php

namespace app\models\entities;

use \app\models\Entity;

class Products extends Entity
{
    public $id = null;
    public $name;
    public $description;
    public $price;
    public $category_id;

    protected $props = [

    ];

    public function __construct($name = null,
                                $description = null,
                                $price = null,
                                $category_id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category_id = $category_id;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }
}