<?php

namespace Session;

// Handles user sessions for logged in users.
class Session
{
    public static function exists($name) 
    {
        return (isset($_SESSION[$name])) ? true : false; // Returns true if any variable associated with a session exists and has a value.
    }

    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value; // Creates session variable and gives it a value (ex asd@email.com or Eric123)
    }

    public static function get($name)
    {
        return $_SESSION[$name]; // Returns value of session variable (ex asd@email.com or Eric123)
    }

    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]); // Deletes session including variables and values.
        }
    }

    public static function flashMessage($name, $message = "") // Messages displayed for user.
    {
        if (self::exists($name)) { // Returns true if message exists.
            $session = self::get($name); // Gets the actual text message
            self::delete($name); // Deletes message session
            return $session;
        } else {
            self::put($name, $message); // Creates message
        }
    }
}
