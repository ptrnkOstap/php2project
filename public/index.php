<?php
session_start();

use app\engine\App;

require_once '../vendor/autoload.php';

$config = include "../config/config.php";

try {
    App::call()->run($config);

} catch (Exception $ex) {
    echo $ex->getMessage() . '<br>';
    echo 'file - ' . $ex->getFile() . '<br>';
    echo 'line - ' . $ex->getLine() . '<br>';
}


