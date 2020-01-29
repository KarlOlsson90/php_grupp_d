<?php

namespace Testing;

use PHPUnit\Framework\TestCase;
use Validate\Validate;

class ValidateTest extends TestCase
{
    protected $Validate;

    // Validate that all login fields have entered input.
    public function testCheckIfAllLoginFieldsHaveInput()
    {
        $validate = new Validate();
        $_POST['username'] = 'Alexander';
        $_POST['password'] = '123';

        $validate->check($_POST, array(
            'username' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            ),
        ));

        $this->assertTrue($validate->passed());
    }

    /* Validate that username in register form is unique against our DB */
    public function testCheckIfAllRegisterFieldsHaveInputAndError()
    {
        $validate = new Validate();
        $_POST['username'] = 'Alexander';
        $_POST['password'] = '123';

        $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'unique' => 'users',
            ),
            'email' => array(
                'required' => true,
                'email' => true,
            ),
            'password' => array(
                'required' => true,
            ),
            're-password' => array(
                'required' => true,
                'matches' => 'password',
            ),
        ));

        $this->assertEquals('Username is already taken', $validate->error());
    }
}
