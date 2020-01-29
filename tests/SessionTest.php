<?php

namespace Testing;

use PHPUnit\Framework\TestCase;
use Session\Session;

class SessionTest extends TestCase
{
    // Setting up a active session.
    public function testSettingUpActiveSession()
    {
        $this->assertEquals('Alexander', Session::put('user', 'Alexander'));
    }

    // Deleting a active session and checking if it still exists.
    public function testDeletingAActiveSessionAndCheckIfSessionStillExists()
    {
        Session::put('user', 'Alexander');
        Session::delete('user');
        $this->assertEquals(null, Session::exists('user'));
    }

    // Setting up a flashMessage then checking if we have a flashMessage to display.
    public function testSettingUpAFlashMessage()
    {
        Session::flashMessage('error', 'Username is taken');
        $this->assertEquals('Username is taken', Session::flashMessage('error'));
    }
}
