<?php

namespace Website\Demo;

use EOF\HTTP\Response\Response;
use EOF\Page\Page;

/**
 * Demo Homepage
 */
final class Homepage implements Page
{

    /**
     * @inheritDoc
     */
    public function contentTo(Response $response): Page
    {
        $response->send('<h1>Demo homepage</h1>');

        return $this;
    }

}
