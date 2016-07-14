<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 10:03 PM
 */

$this->get('login', ['as' => 'login.get', 'uses' => 'Auth\AuthController@showLoginForm']);
$this->post('login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@login']);
$this->get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes...
$this->get('register', ['as' => 'register.get', 'uses' => 'Auth\AuthController@showRegistrationForm']);
$this->post('register', ['as' => 'register.post', 'uses' => 'Auth\AuthController@register']);

// Password Reset Routes...
$this->get('password/reset/{token?}', ['as' => 'reset.get', 'uses' => 'Auth\PasswordController@showResetForm']);
$this->post('password/email', ['as' => 'reset.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
$this->post('password/reset', ['as' => 'reset.post', 'uses' => 'Auth\PasswordController@reset']);