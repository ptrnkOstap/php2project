<?php

namespace app\controllers;

use app\engine\App;
use app\controllers\Controller;
use app\engine\Request;
use app\models\entities\{Carts, Order, Products};

class CartController extends Controller
{
    public function __get($name)
    {
        if ($name === 'cart' && (!isset($this->cart))) {
            $this->cart = App::call()->cartsRepository->getCart($this->session_id);
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
        $productId = (int)App::call()->request->getParams()['id'];
        $unitPrice = (float)App::call()->productRepository->getOne($productId)->price;
        $alreadyAdded = false;

        foreach ($this->cart as $cartLine) {
            if ((int)$cartLine['prod_id'] === $productId) { //проверяем, есть ли уже такой артикул в корзине
                $alreadyAdded = true;
                $alterQuantity = App::call()->cartsRepository->getOne($cartLine['cart_line_id']); // этот код вызывается 1 раз, если в корзину
                $alterQuantity->quantity += 1;  // добавляется уже существующий артикул
                App::call()->cartsRepository->update($alterQuantity);
            }
        }
        if ($alreadyAdded == false) {
            $newCartLine = new Carts($unitPrice, $this->session_id, $productId);
            App::call()->cartsRepository->insert($newCartLine);
        }

        $response = [
            'success' => 'ok',
            'count' => App::call()->cartsRepository->getCountWhere('session_id', $this->session_id)];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {
        $lineId = (int)App::call()->request->getParams()['id']; // проверить
        $cartLine = App::call()->cartsRepository->getOne($lineId);
        if ($this->session_id === $cartLine->session_id) {
            App::call()->cartsRepository->delete($cartLine);
        }

        $response = [
            'success' => 'ok',
            'count' => App::call()->cartsRepository->getCountWhere('session_id', $this->session_id)];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }


    public function actionPlaceOrder()
    {
        $orderData = App::call()->request->getParams();
        $order = new Order($orderData['name'], $orderData['address'], App::call()->session->getId(), $orderData['email']);

        App::call()->ordersRepository->insert($order);
        App::call()->session->destroy();
        App::call()->session->regenerate();

        $response = [
            'success' => 'ok',
            'message' => 'Thank you. Order #' . App::call()->db->LastInsertId() . ' on its way to you.'
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        header('location: /cart/index');
        die();

    }


}