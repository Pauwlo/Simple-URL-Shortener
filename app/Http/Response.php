<?php

namespace App\Http;

class Response
{
    /**
     * Create a new response instance.
     * 
     * @return void
     */
    public function __construct(
        /**
         * The response body.
         * 
         * @var string
         */
        private string $body = '',

        /**
         * The response status code.
         * 
         * @var int
         */
        private int $statusCode = 200,

        /**
         * The response headers.
         * 
         * @var array
         */
        private array $headers = []
    ) {
    }

    /**
     * Get the response body.
     * 
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set the response body.
     * 
     * @param string $body
     * @return \App\Http\Response
     */
    public function setBody(string $body): Response
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the response status code.
     * 
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Set the response status code.
     * 
     * @param int $statusCode
     * @return \App\Http\Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get the response headers.
     * 
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set a response header.
     * 
     * @param string $key
     * @param string $value
     * @return \App\Http\Response
     */
    public function setHeader(string $key, string $value): Response
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * Set the response headers.
     * Can merge or replace the existing set of headers.
     * 
     * @param array $headers
     * @param bool $replace
     * @return \App\Http\Response
     */
    public function setHeaders(array $headers, bool $replace = false): Response
    {
        if ($replace) {
            $this->headers = $headers;
            return $this;
        }

        foreach ($headers as $key => $value) {
            $this->setHeader($key, $value);
        }

        return $this;
    }

    /**
     * Send the response headers.
     * 
     * @return \App\Http\Response
     */
    public function sendHeaders(): Response
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        return $this;
    }

    /**
     * Send the response body.
     * 
     * @return \App\Http\Response
     */
    public function sendBody(): Response
    {
        echo $this->body;

        return $this;
    }

    /**
     * Send the response headers and body.
     * 
     * @return \App\Http\Response
     */
    public function send(): Response
    {
        $this->sendHeaders();
        $this->sendBody();

        return $this;
    }
}
