<?php

namespace Validate;

use Db\Database;

class Validate extends Database
{
    private $passed;
    private $error;

    public function check($method, $items = array()) // Primary validation function with the values in an array. $Method represents request type.
    {
        foreach ($items as $item => $rules) { // Loops through all items rules.
            foreach ($rules as $rule => $rule_value) { // loops through all rules associated with each item.
                $input_value = trim($method[$item]); // Removes empty spaces
                if ($rule === 'required' && empty($input_value)) { // Checks if an input is required and if it is left empty.
                    $this->setError("$item is required"); // returns an error with the name of the input that it is required.
                    return;
                } elseif (!empty($input_value)) {  // Check if value is not empty.
                    if ($rule === 'email') { // Check if the input is associated with email.
                        if (!filter_var($input_value, FILTER_VALIDATE_EMAIL)) { // Controls that submitted email is in email format (x@y.z).
                            $this->setError("Invalid $item"); // Error if mail input doesnt match email adress format ^.
                            return;
                        }
                    } elseif ($rule === 'matches') { // Check if input has the rule "matches" (password).
                        if ($input_value != $method[$rule_value]) { // Check if password is not equal to its other instance (rule value is the other password)
                            $this->setError("Passwords don't match"); // Error if passwords doesnt match.
                            return;
                        }
                    } elseif ($rule === 'unique') { // Check if input has the rule "unique" (username).
                        $check = self::query("SELECT * FROM users WHERE username = ?", array($input_value)); // Look up username in database.
                        if (count($check)) { // returns true if sum > 0 (if username exists).
                            $this->setError("Username is already taken"); // Error.
                            return;
                        }
                    }
                }
            }
        }
        if (!isset($this->error)) { // Check if no errors occured
            $this->passed = true; // Set passed variable to true if no error occured in above block.
        }
    }

    //Getters and setters for variables
    private function setError($error) //Function locked/scoped to current class (validate)
    {
        $this->error = $error;
        $this->passed = false;
    }

    public function error()
    {
        return $this->error;
    }

    public function passed()
    {
        return $this->passed;
    }
}
