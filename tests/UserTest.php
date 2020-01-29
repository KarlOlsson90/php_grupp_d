<?php

namespace Testing;

use PHPUnit\Framework\TestCase;
use User\User;

class UserTest extends TestCase
{
     protected $User;

    // Check if we have any existing user with the name Alexander in our database.
    public function testFindExistingUserInDatabase()
    {
        $user = new User();
        $this->assertTrue($user->find('Alexander'));
    }

    // Trying to login with right credentials from our database.
    public function testLoginWithRightCredentials()
    {
        $user = new User();
        $this->assertTrue($user->login('Alexander', 'Alexander'));
    }

    // Trying to login with wrong credentials from our database.
    public function testLoginWithWrongCredentials()
    {
        $user = new User();
        $this->assertFalse($user->login('LOREM IPSUM', 'LOREM IPSUM'));
    } 
}
