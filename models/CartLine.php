<?php

namespace app\models;

class CartLine
{
    public  $product;
    public  $quantity;

    //возможно, перед созданием строки в корзине нужно
    // чекать доступное количество из БД

    public function __construct(Products $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
}