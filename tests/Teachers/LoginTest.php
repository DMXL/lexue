<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Teachers\TeacherTestCase;

class LoginTest extends TeacherTestCase
{
    /**
     * Test the login redirect
     */
    public function testLoginRedirect()
    {
        $this->visit('/')
            ->seePageIs('/login');
    }

    /**
     * Test the actual login functionality.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->visit('/login')
            ->type(config('auth.test.email'), 'email')
            ->type(config('auth.test.password'), 'password')
            ->check('remember')
            ->press('登录')
            ->seePageIs('/');
    }
}
