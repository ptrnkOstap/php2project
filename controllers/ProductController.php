<?php

namespace app\controllers;

use app\controllers\Controller;
use app\models\Products;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $catalog = Products::getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }

    public function actionSingleProduct()
    {
        $id = $_GET['id'];
        $product = Products::getOne($id);
//        var_dump($product);
        echo $this->render('SingleProduct', ['product' => $product]);
    }



}