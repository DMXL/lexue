<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function testLoginRedirect()
    {
        $this->visit('/')
            ->assertRedirectedTo('login');
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
