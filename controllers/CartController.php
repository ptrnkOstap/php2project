<?php

namespace app\controllers;

use app\controllers\Controller;
use app\engine\Request;
use app\models\Carts;
use app\models\Products;

class CartController extends Controller
{

    public function actionIndex()
    {
        $session_id = session_id();
        $cart = Carts::getCart($session_id);
//        var_dump($cart);


        echo $this->render('cart', ['cart' => $cart]);
    }

    public function actionAdd()
    {
        $productId = (int)(new Request())->getParams()['id'];
        $unitPrice = (float)Products::getOne($productId)->price;
        $session_id = session_id();

        (new Carts($unitPrice, $session_id, $productId))->save();
        header("Location:/product/catalog");
        die();
    }

    public function actionDelete($id)
    {
        $session_id = session_id();
        $cart = Carts::getCart($session_id);

        $cart->delete($id);
    }


}