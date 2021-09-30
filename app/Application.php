<?php

namespace App;

class Application
{
    /**
     * The application instance.
     * 
     * @var \App\Application
     */
    private static $instance;

    /**
     * Return a unique instance of the application.
     * 
     * @return \App\Application
     */
    public static function getInstance(): Application
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct() {}

    /**
     * Run the application.
     * 
     * @return void
     */
    public function run()
    {
        echo 'Hello world!';
    }
}