<?php

namespace app\controllers;

use app\engine\App;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $orders = App::call()->ordersRepository->getOrders();
        echo $this->render('admin', ['orders' => $orders]);
    }

    public function actionOrder()
    {
        App::call()->ordersRepository->placeOrder();
    }
}