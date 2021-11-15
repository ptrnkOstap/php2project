<?php

namespace app\models;


class Products extends DBModel
{
    protected $id = null;
    protected $name;
    protected $description;
    protected $price;
    protected $category_id;

    protected $props = [];

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


    public static function getTableName()
    {
        return 'products';
    }


}