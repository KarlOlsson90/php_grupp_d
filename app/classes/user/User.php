<?php

namespace User;

use Db\Database;
use Session\Session;

class User extends Database
{
    private $user_info;
    private $isLoggedIn;

    public function __construct($user = null) // constructor for user class
    {
        if (Session::exists('user')) { // Checks if a session with the name "user" exists
            $user = Session::get('user'); // Gets values from the session and saves them in variable
            if ($this->find($user)) { // Sends above values into find function
                $this->isLoggedIn = true; //sets "isLoggedIn" to true if above function returns true
            } else {
                //logout
            }
        }
    }

    public function create($values = array()) // NOT USED
    {
        self::query("INSERT INTO users (username, userEmail, userPassword)  VALUES (?,?,?)", $values); //Inserts new user into database
    }

    public function find($user = null)
    {
        if ($user) { // Checks if varible user is set
            $data = self::query("SELECT * FROM users WHERE username = ?", array($user)); // checks if data of user exists in database
            if (count($data)) { // Checks if any data exists
                $this->user_info = $data;   // Saves data into variable
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null)
    {
        $user = $this->find($username); // Checks if user exists in database
        if ($user) {
            if (password_verify($password, $this->user_info[0]["userPassword"])) { //Check if password match
                Session::put('user', $this->user_info[0]["username"]); // Sends username to session
                Session::put('email', $this->user_info[0]["userEmail"]); // Sends user email to session
                return true;    // returns true to indicate successful login
            } else {
                Session::flashMessage('error', 'Wrong password');
                return false;
            }
        }
        Session::flashMessage('error', "Username don't exists");
        return false;
    }

    public function isLoggedIn()
    {
        return $this->isLoggedIn;
    }

    public function logout()
    {
        Session::delete('user');
    }
}
