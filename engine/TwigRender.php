<?php

namespace app\engine;

class TwigRender implements \app\interfaces\IRenderer
{
    private $loader;
    private $twig;

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(TWIG_TEMPLATES_DIR);
        $this->twig = new \Twig\Environment($this->loader, ['debug' => true]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function renderTemplate($template, $params = [])
    {
        $fullPath = $template . '.twig';
        return $this->twig->render($fullPath, $params);
    }
}