<?php

spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $pathClass = './classes/' . $className . '.php';

    if(file_exists($pathClass)){
        require $pathClass;
    }
}

?>
