<?php

namespace Website\Demo;

use EOF\HTTP\Response\Response;
use EOF\Page\Page;
use EOF\Website\Website as WebsiteInterface;

/**
 * Demo Website
 */
final class Website implements WebsiteInterface
{

    /** @var Page **/
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @inheritDoc
     */
    public function sendThrough(Response $response): WebsiteInterface
    {
        $this->page->contentTo($response);

        return $this;
    }

}
