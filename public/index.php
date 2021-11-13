<?php
session_start();

use app\engine\Db;
use app\models\{Carts, CartLine, Products, User};
use app\models\Orders;
use \app\controllers\ProductController;
use \app\engine\TwigRender;
use \app\engine\Request;


include '../config/config.php';
//include "../engine/Autoload.php";
require_once '../vendor/autoload.php';

//spl_autoload_register([new app\engine\Autoload(), 'loadClass']);
try {


    $request = new Request();
    $controllerName = $request->getControllerName() ?: 'product';
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {

        $controller = new $controllerClass(new TwigRender);
        $controller->runAction($actionName);
    } else {
        die("404");
    }
} catch (Exception $ex) {
    echo $ex->getMessage() . '<br>';
    echo 'file - ' . $ex->getFile() . '<br>';
    echo 'line - ' . $ex->getLine() . '<br>';
}


