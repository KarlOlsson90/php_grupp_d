<?php

namespace Testing;

use PHPUnit\Framework\TestCase;
use Validate\Validate;

class ValidateTest extends TestCase
{
    protected $Validate;

    public function setUp()
    {
        $this->Validate = new Validate();
        $_POST['username'] = 'Alexander';
        $_POST['password'] = '123';
    }

    // Validate that all login fields have entered input.
    public function testCheckIfAllLoginFieldsHaveInput()
    {
        $this->Validate->check($_POST, array(
            'username' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            ),
        ));

        $this->assertTrue($this->Validate->passed());
    }

    /* Validate that username in register form is unique against our DB */
    public function testCheckIfAllRegisterFieldsHaveInputAndError()
    {
        $this->Validate->check($_POST, array(
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

        $this->assertEquals('Username is already taken', $this->Validate->error());
    }
}
