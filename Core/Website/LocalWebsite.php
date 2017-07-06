<?php

namespace EOF\Website;

use EOF\HTTP\Response\Response;
use EOF\Page\Page;
use EOF\Website\Website;

/**
 * Default Web Site
 */
final class LocalWebsite implements Website
{

    /** @var Page **/
    private $page;

    /**
     * @param string $index
     * @param string $name
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @inheritDoc
     */
    public function displayThrough(Response $response): Website
    {
        $response->send(
            $this->page->content()
        );

        return $this;
    }

}
