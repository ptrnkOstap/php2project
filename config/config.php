<?php

//define('ROOT', dirname(__DIR__));
//const DS = DIRECTORY_SEPARATOR;
//const CONTROLLER_NAMESPACE = "app\\controllers\\";
//const VIEWS_DIR = "..\\views\\";
const TWIG_TEMPLATES_DIR = "..\\templates";
//const PROJECT_DIR = "C:\Users\Dmitriy\IdeaProjects\php2project\app";


/*define('ROOT', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER_NAMESPACE', 'app\\controllers\\');
define("VIEWS_DIR", '../views/');*/

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\models\repositories\CartsRepository;
use app\models\repositories\ProductsRepository;
use app\models\repositories\UserRepository;
use app\models\repositories\OrdersRepository;

return [
    'root' => dirname(__DIR__),
    'controllers_namespaces' => 'app\\controllers\\',
    'product_per_page' => 2,
    'views_dir' => dirname(__DIR__) . "/views/",
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:3306',
            'login' => 'mysql',
            'password' => '',
            'database' => 'mystore',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'ordersRepository' => [
            'class' => OrdersRepository::class
        ],
        'cartsRepository' => [
            'class' => CartsRepository::class
        ],
        'productRepository' => [
            'class' => ProductsRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ],
        'session' => [
            'class' => Session::class
        ]
    ]
];
