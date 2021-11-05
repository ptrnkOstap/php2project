<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $path = ".." . stristr($className, "\\") . ".php"; //отрезает по первому слешу
        include $path;
    }
}

