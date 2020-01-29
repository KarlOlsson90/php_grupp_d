<?php

namespace Testing;

use PHPUnit\Framework\TestCase;
use Input\Input;

class InputTest extends TestCase
{
    // Check if we have any clicked any submit button.
    public function testCheckIfWeHavePressedSubmit()
    {
        $this->assertFalse(Input::exists());
    }

    // Get value from a specific input field.
    public function testGetValueFromInputField()
    {
        $_POST['username'] = 'Andreas';
        $this->assertEquals('Andreas', Input::get('username'));
    }
}
