<?php

namespace EOF\Website;

use EOF\HTTP\Response\Response;

/**
 * Web Site Interface.
 */
interface Website
{

    /**
     * Sends the website to the client.
     * @param  Response $response
     * @return Website
     */
    public function sendThrough(Response $response): Website;

}
