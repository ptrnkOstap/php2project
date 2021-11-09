<?php
session_start();

use app\engine\Db;
use app\models\{Carts, CartLine, Products, User};
use app\models\Orders;
use \app\controllers\ProductController;
use \app\engine\TwigRender;
use \app\engine\Request;


include '../config/config.php';
include "../engine/Autoload.php";
require_once '../vendor/autoload.php';

spl_autoload_register([new app\engine\Autoload(), 'loadClass']);

$request = new Request();

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    var_dump($controllerClass);
    var_dump($actionName);
    $controller = new $controllerClass(new TwigRender);
    $controller->runAction($actionName);
} else {
    die("404");
}

//$cart = Carts::getOne(55);
//var_dump($cart);
//$cart->delete();
//var_dump($cart);
//$cart->quantity += 5;
//var_dump($cart);
//$cart->update();
//var_dump($cart);


//$cartLine = new CartLine($product, 2);
//$cartLine2 = new CartLine($product, 3);
//$cartLine3 = new CartLine($product2, 2);
//$cart = new Carts($cartLine);
//
//$cart->addProduct($cartLine2);
//$cart->addProduct($cartLine3);
//
////Задание с геометрическими фигурами
//
//$rect = new \app\figure\Rectangle(2, 4);
//$circle = new \app\figure\Circle(5);
//$triangle = new \app\figure\Triangle(2, 3, 5, 2);
//
//$rect->showResult();
//
//echo '<br>';
//echo '<br>';
//
//
//$triangle->showResult();
//
//
//echo '<br>';
//echo '<br>';
//
//
//$circle->showResult();