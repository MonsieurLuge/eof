<?php

namespace EOF\Page;

use EOF\HTTP\Response\Response;
use EOF\Page\Page;

/**
 * A Basic #404 Page.
 */
final class NotFound implements Page
{

    /**
     * @inheritDoc
     */
    public function contentTo(Response $response): Page
    {
        $response->send('#404 - Page not found');
    }

}
