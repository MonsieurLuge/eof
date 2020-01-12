<?php

namespace EOF\HTTP\Response;

/**
 * Response Interface
 */
interface Response
{

    /**
     * Sends the response to the client.
     * @param  string $content
     * @return Response
     */
    public function send(string $content): Response;

}
