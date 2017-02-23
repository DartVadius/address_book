<?php
define('ROOT', (__DIR__) . DIRECTORY_SEPARATOR);

function autoloadMain($class) {
    preg_match_all('/[A-Z][^A-Z]*/', $class, $results);
    $results =  end($results[0]);
    $pathToClassFile = __DIR__ . '/'. strtolower($results). '/' . $class.'.php';
    if (file_exists($pathToClassFile)) {
        require_once $pathToClassFile;
    }
}

spl_autoload_register('autoloadMain');
require_once ROOT . 'core/application.php';
// start the application
$app = new Application();
$app->run();