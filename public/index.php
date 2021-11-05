<?php

use app\engine\Db;
use app\models\{Cart, CartLine, Products, User};
use app\models\Orders;
use \app\controllers\ProductController;
use \app\engine\TwigRender;


include '../config/config.php';
include "../engine/Autoload.php";
require_once '../vendor/autoload.php';

spl_autoload_register([new app\engine\Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?? 'product';
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender);
    $controller->runAction($actionName);
} else {
    die("404");
}


//$db = new Db();
//$product = new Products();
//var_dump($product->getOne(2));
//var_dump($product->getAll());

//$product = new Products();
//$product->insert();
//$product = Products::getOne(4);
//var_dump($product);
//$product->price = 55;// задаю новое значение для свойства, но сеттер не реагирует :(
//var_dump($product->shiftedKeys);
//var_dump($product);
//var_dump($product);
//$product->update();
//$product->delete();
//$user = new User('name', 'surname', 'example@mail.ru', 'asdasd');
//$user->insert();

//$product = new Products(1, 'hat', 'thinking hat', 10);
//$product2 = new Products(2, 'test2', 'sleeping boat', 20);
//var_dump($product->getOne(1));
//echo '<br>';
////var_dump($product->getAll());
//
//echo '<br>';
//echo '<pre>';
//var_dump($product);
//echo '</pre>';
//
//$cartLine = new CartLine($product, 2);
//$cartLine2 = new CartLine($product, 3);
//$cartLine3 = new CartLine($product2, 2);
//$cart = new Cart($cartLine);
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