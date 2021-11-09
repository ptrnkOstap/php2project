<?php

namespace app\controllers;

use app\controllers\Controller;
use app\engine\Request;
use app\models\Carts;
use app\models\Products;

class CartController extends Controller
{
    public function __get($name)
    {
        if ($name === 'cart' && (!isset($this->cart))) {
            $this->cart = Carts::getCart($this->session_id);
        }
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

    public function actionIndex()
    {
        echo $this->render('cart', ['cart' => $this->cart]);

    }

    public function actionAdd()
    {
        $productId = (int)(new Request())->getParams()['id'];
        $unitPrice = (float)Products::getOne($productId)->price;
        $alreadyAdded = false;

        foreach ($this->cart as $cartLine) {
            if ((int)$cartLine['prod_id'] === $productId) {
                $alreadyAdded = true;
                $alterQuantity = Carts::getOne($cartLine['cart_line_id']);
                $alterQuantity->quantity += 1;
                $alterQuantity->update();
            }
        }
        $alreadyAdded ?: (new Carts($unitPrice, $this->session_id, $productId))->insert();

        $response = [
            'success' => 'ok',
            'count' => Carts::getCountWhere('session_id', $this->session_id)];
//        header("Location:/product/catalog");
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {
        $lineId = (int)(new Request())->getParams()['id'];
        $cartLine = Carts::getOne($lineId);
        var_dump($cartLine);
        $cartLine->delete();

        $response = [
            'success' => 'ok',
            'count' => Carts::getCountWhere('session_id', $this->session_id)];
//        header("Location:/product/catalog");
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }


}