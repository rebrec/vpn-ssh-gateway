<?php
spl_autoload_register('autoload');

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, __DIR__ . "\\" . $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    if (!file_exists($filename)) {
        echo "Class to load : <br/>";
        var_dump($className);
        echo " ===> Looking for : <br/>";
        var_dump($fileName);
    }
    require $fileName;
}
