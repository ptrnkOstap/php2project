<?php

namespace app\controllers;

use app\engine\App;
use app\interfaces\IRenderer;
use app\models\entities\{User, Carts};
use app\models\repositories\{UserRepository, CartsRepository};

class Controller
{
    private $action;
    protected $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;
    protected $session_id; //определяется в конструкторе Controller

    protected $render;

    public function __set($name, $value)
    {

        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __construct(IRenderer $render)

    {
        $this->session_id = App::call()->session->getId();
        $this->render = $render;
    }


    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate('layouts/' . $this->layout, [
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => App::call()->userRepository->isAuth(),
                    'username' => App::call()->userRepository->getName(),
                    'count' => App::call()->cartsRepository->getCountWhere('session_id', session_id()),
                ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }

    }

//
    public function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}