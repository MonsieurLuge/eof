<?php

namespace EOF\Website;

use EOF\HTTP\Response\Response;

/**
 * Web Site Interface.
 */
interface Website
{

    /**
     * TODO [content description]
     * @param  string  $content
     * @return Website
     */
    public function content(string $content): Website;

    /**
     * Displays the website to the client.
     * @param  Response $response
     * @return Website
     */
    public function displayThrough(Response $response): Website;

}
