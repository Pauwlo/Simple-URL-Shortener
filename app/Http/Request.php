<?php

namespace App\Http;

class Request
{
    /**
     * The request URI.
     * 
     * @var string
     */
    private string $uri;

    /**
     * Create a new request instance.
     * 
     * @return void
     */
    private function __construct(
        /**
         * The request query string parameters. ($_GET)
         * 
         * @var array
         */
        private array $query = [],

        /**
         * The request data when POST is used. ($_POST)
         * 
         * @var array
         */
        private array $body = [],

        /**
         * The request cookies. ($_COOKIE)
         * 
         * @var array
         */
        private array $cookies = [],

        /**
         * The server and execution environment parameters. ($_SERVER)
         * 
         * @var array
         */
        private array $server = [],
    ) {
        $this->uri = $server['REQUEST_URI'];
    }

    /**
     * The server and execution environment parameters. ($_SERVER)
     * 
     * @return \App\Http\Request
     */
    public static function createFromGlobals(): Request
    {
        return new static($_GET, $_POST, $_COOKIE, $_SERVER);
    }

    /**
     * Get the request query string parameters.
     * 
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * Get the request data.
     * 
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * Get the request cookies.
     * 
     * @return array
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }

    /**
     * Get the server and execution environment parameters.
     * 
     * @return array
     */
    public function getServer(): array
    {
        return $this->server;
    }

    /**
     * Get the request HTTP method.
     * 
     * @return string
     */
    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    /**
     * Get the request URI.
     * 
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Get the request client IP address.
     * 
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->getServer()['REMOTE_ADDR'];
    }
}
