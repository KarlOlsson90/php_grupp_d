<?php

namespace Input;

// Handles inputs from forms.
class Input
{   
    public static function exists($type = 'post')
    {   
        if ($type == 'post') { // Checks if a post request is made.
            
            return (!empty($_POST)) ? true : false; // Returns true if associated fields of POST request are not empty.
        } elseif ($type == 'get') {
            // Returns true if associated fields of GET request are not empty (for eventual future use)
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

        // Returns filled in GET item - if it exists (for eventual future use).
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }
}
