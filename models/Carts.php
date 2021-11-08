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
        'session_id' => false,
        'product_id' => false
    ];

    public function __construct($price, $session_id = null, $product_id = null, $quantity = 1, $user_id = null)
    {
        $this->price = $price;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
    }

    public
    static function getCart($session_id)
    {
        $sql = "SELECT 
                    p.id prod_id,
                    p.name,
                    p.description,
                    p.price
                FROM `carts` c INNER JOIN `products` p ON c.product_id=p.id
                WHERE `session_id` = :session_id";

        return Db::getInstance()->queryAll($sql, ['session_id' => $session_id]);
    }

    public
    static function getTableName()
    {
        return 'carts';
    }

}