<?php

namespace EOF\HTTP\Response;

/**
 * Response Interface
 */
interface Response
{

    /**
     * Sends the response to the client.
     * @return Response
     */
    public function send($header, $content) : Response;

}
