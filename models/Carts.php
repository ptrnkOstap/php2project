<?php

namespace app\models;

use app\engine\Db;

class Carts extends DBModel
{
    protected $id; // в БД нет id Для cart
    protected $session_id;
    protected $product_id;
    protected $quantity;
    protected $price;
    protected $user_id;


    protected $props = [
    ];


    public function __construct($price=null, $session_id = null, $product_id = null, $quantity = 1, $user_id = null)
    {
        $this->price = $price;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
    }

    public static function getCart($session_id)
    {
        $sql = "SELECT 
                    c.id cart_line_id,
                    p.id prod_id,
                    p.name,
                    p.description,
                    p.price,
                    c.quantity quantity
                FROM `carts` c INNER JOIN `products` p ON c.product_id=p.id
                WHERE `session_id` = :session_id";

        return Db::getInstance()->queryAll($sql, ['session_id' => $session_id]);
    }

    public static function getTableName()
    {
        return 'carts';
    }

}