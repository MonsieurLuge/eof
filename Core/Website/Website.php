<?php

namespace EOF\Website;

use EOF\HTTP\Response\Response;

/**
 * Web Site Interface.
 */
interface Website
{

    /**
     * Displays the website to the client.
     * @param  Response $response
     * @return Website
     */
    public function displayThrough(Response $response): Website;

}
