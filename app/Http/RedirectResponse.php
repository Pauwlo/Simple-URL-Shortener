<?php

namespace App\Http;

class RedirectResponse extends Response
{
    /**
     * Create a new redirect response instance.
     * 
     * @return void
     */
    public function __construct(
        /**
         * The redirection destination URL.
         * 
         * @var string
         */
        private string $url,

        /**
         * The redirection status code.
         * Defaults to a permanent redirection.
         * 
         * @var int
         */
        private int $statusCode = 301,

        /**
         * The redirection headers.
         * 
         * @var array
         */
        private array $headers = []
    ) {
        parent::__construct('', $statusCode, $headers);

        $this->setHeader('Location', $url);
        $this->setBody($this->getRedirectionBody($url));
    }

    /**
     * Get the redirection destination URL.
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Generate a simple HTML document for clients
     * that may not follow the Location header.
     * 
     * @param string $url
     * @return string
     */
    public function getRedirectionBody(string $url): string
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0;url='$url'">
    <title>Redirecting</title>
</head>
<body>
    <p>Redirecting to <a href="$url">$url</a>...
</body>
</html>
HTML;
    }
}
