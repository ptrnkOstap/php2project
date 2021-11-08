<?php

namespace app\controllers;

use app\controllers\Controller;
use app\engine\Request;
use app\models\DBModel;
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
        echo $this->render('catalog/index', ['catalog' => $catalog]);
    }

    public function actionCard()
    {

        $id = $_GET['id'];
        $product = Products::getOne($id);
        echo $this->render('catalog/card', ['product' => $product]);
    }


}