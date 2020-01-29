<?php

namespace Input;

// Handles inputs from forms (POST).
class Input
{   
    public static function exists($type = 'post')
    {   
        if ($type == 'post') {
            // Returns true if associated fields of POST request are not empty.
            return (!empty($_POST)) ? true : false;
        } elseif ($type == 'get') {
            // Returns true if associated fields of GET request are not empty (? type är lika med post i parametrarna för exists-funktionen ?)
            return (!empty($_GET)) ? true : false;
        } else {
            return false;
        }
    }
    
    public static function get($item)
    {   
        // Returns filled in POST item - if it exists.
        if (isset($_POST[$item])) {
            return $_POST[$item];

        // Returns filled in GET item - if it exists.
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }
}
