<?php

namespace app\engine;

use app\interfaces\IRenderer;
use app\models\repositories\CartsRepository;
use app\models\repositories\ProductsRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingletone;


/**
 * Class App
 * @property Request $request
 * @property BasketRepository $basketRepository
 * @property UserRepository $usersRepository
 * @property ProductRepository $productRepository
 * @property Session $session
 * @property Db $db
 */
class App
{
    use TSingletone;

    public $config;
    private $components;

    private $controller;
    private $action;

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function runController() {
        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new TwigRender() );
            $controller->runAction($this->action);
        } else {
            echo "404";
        }
    }

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    public function createComponent($name) {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);//new $class($params)
            }
        }
        die("Компонента {$name} не существует в конфигурации системы!");
    }

    public function __get($name)
    {
        return $this->components->get($name);
    }

}