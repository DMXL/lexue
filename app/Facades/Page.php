<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 11:15 AM
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Page extends Facade
{
    protected static function getFacadeAccessor() { return 'page'; }
}