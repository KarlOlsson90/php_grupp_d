<?php

namespace Testing;

use PHPUnit\Framework\TestCase;
use User\User;

class UserTest extends TestCase
{
    protected $User;

    // Setting up a User object, that we can use in every test.
    public function setUp()
    {
        $this->User = new User();
    }

    // Check if we have any existing user with the name Alexander in our database.
    public function testFindExistingUserInDatabase()
    {
        $this->assertTrue($this->User->find('Alexander'));
    }

    // Trying to login with right credentials from our database.
    public function testLoginWithRightCredentials()
    {
        $this->assertTrue($this->User->login('Alexander', 'Alexander'));
    }

    // Trying to login with wrong credentials from our database.
    public function testLoginWithWrongCredentials()
    {
        $this->assertFalse($this->User->login('LOREM IPSUM', 'LOREM IPSUM'));
    }
}
