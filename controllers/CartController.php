<?php

namespace app\controllers;

use app\controllers\Controller;

class CartController extends Controller
{
    protected $defaultAction = 'ShowCart';

    public function actionShowCart()
    {
        echo $this->render('cart');
    }
}