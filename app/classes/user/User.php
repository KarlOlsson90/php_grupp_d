<?php

namespace User;

use Db\Database;
use Session\Session;

class User extends Database
{
    private $user_info;
    private $isLoggedIn;

    public function __construct($user = null)
    {
        if (Session::exists('user')) {
            $user = Session::get('user');
            if ($this->find($user)) {
                $this->isLoggedIn = true;
            } else {
                //logout
            }
        }
    }

    public function create($values = array())
    {
        self::query("INSERT INTO users (username, userEmail, userPassword)  VALUES (?,?,?)", $values);
    }

    public function find($user = null)
    {
        if ($user) {
            $data = self::query("SELECT * FROM users WHERE username = ?", array($user));
            if (count($data)) {
                $this->user_info = $data;
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null)
    {
        $user = $this->find($username);
        if ($user) {
            if (password_verify($password, $this->user_info[0]["userPassword"])) {
                Session::put('user', $this->user_info[0]["username"]);
                Session::put('email', $this->user_info[0]["userEmail"]);
                return true;
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
