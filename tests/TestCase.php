<?php

namespace Tests;

if (! defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
}
