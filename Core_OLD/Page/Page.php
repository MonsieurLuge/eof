<?php

namespace EOF\Page;
use EOF\HTTP\Response\Response;

/**
 * Page Interface
 */
interface Page
{

    /**
     * TODO [content description]
     * @return Page
     */
    public function contentTo(Response $response): Page;

}
