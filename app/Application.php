<?php

namespace App;

class Application
{
    private static $instance;

    public static function getInstance(): Application
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct() {}

    public function run()
    {
        echo 'Hello world!';
    }
}