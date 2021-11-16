<?php

namespace app\models\entities;

use \app\models\Entity;

class Carts extends Entity
{
    public $id;
    public $session_id;
    public $product_id;
    public $quantity;
    public $price;
    public $user_id;

    protected $props = [

    ];

    public function __construct($price = null, $session_id = null, $product_id = null, $quantity = 1, $user_id = null)
    {
        $this->price = $price;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

}