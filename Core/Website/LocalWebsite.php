<?php

namespace EOF\Website;

use EOF\HTTP\Response\Response;
use EOF\Website\Website;

/**
 * Default Web Site
 */
final class LocalWebsite implements Website
{

    /** @var string **/
    private $index;
    /** @var string **/
    private $name;

    /**
     * @param string $index
     * @param string $name
     */
    public function __construct(string $name, string $index)
    {
        $this->index = $index;
        $this->name  = $name;
    }

    /**
     * @inheritDoc
     */
    public function content(string $content): Website
    {
        // TODO

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function displayThrough(Response $response): Website
    {
        $response->send("HTTP/1.0 200", '<h1>Demo</h1>');

        return $this;
    }

}
