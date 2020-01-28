<?php

function myAutoLoader($className)
{
    $pathClass = './classes/' . $className . '.php';

    if (file_exists($pathClass)) {
        require $pathClass;
    }
}
