<?php

namespace app\models;

class Cart
{

    public array $cart = [];

    public function __construct(CartLine $newLine)
    {
        array_push($this->cart, $newLine);
    }


    public function getCart()
    {
        return $this->cart;
    }

    public function addProduct(CartLine $newLine)
    {
        foreach ($this->cart as $cartLine)
            if ($cartLine->product->id === $newLine->product->id) {
                $cartLine->quantity += $newLine->quantity;
            } else {
                array_push($this->cart, $newLine);
            }

    }

    public function removeProduct(int $productId)
    {
        foreach ($this->cart as $key => $value) {
            if ($value->product->id === $productId) {
                array_splice($this->cart, $key, 1);
            }
        }
    }

    public function clearCart()
    {
        $this->cart = [];
    }
}

