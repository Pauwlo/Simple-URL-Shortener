<?php

namespace App;

use App\Http\Request;

class Application
{
    /**
     * The application instance.
     * 
     * @var \App\Application
     */
    private static $instance;

    /**
     * The incoming request.
     * 
     * @var \App\Http\Request
     */
    private Request $request;

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

    /**
     * Create an application instance.
     * 
     * @return void
     */
    private function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

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
