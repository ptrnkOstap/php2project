<?php


namespace app\engine;


class TwigRender implements \app\interfaces\IRenderer
{
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(TWIG_TEMPLATES_DIR);
        $this->twig = new \Twig\Environment($loader, ['auto_reload' => true]); //, ['debug' => true]
//        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function renderTemplate($template, $params = [])
    {
//        var_dump($template . '.twig');
        return $this->twig->render($template . '.twig', $params);
    }
}