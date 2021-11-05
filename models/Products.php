<?php

namespace app\models;


class Products extends Model
{
    public  $id;
    public $name;
    public $description;
    public $price;
    public $category_id;


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


    public static function getTableName()
    {
        return 'products';
    }


}