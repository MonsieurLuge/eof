<?php

namespace EOF\Page;

use EOF\HTTP\Request\Request;
use EOF\HTTP\Response\Response;
use EOF\Website\Website;

/**
 * A Page Factory
 */
final class PageFromRequest implements Page
{

    /** @var Page **/
    private $page;
    /** @var Request **/
    private $request;
    /** @var Website **/
    private $website;

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Website $website)
    {
        $this->page    = null;
        $this->request = $request;
        $this->website = $website;
    }

    /**
     * Returns the cached Page or creates if it doesn't exists.
     * @return Page
     */
    private function cachedPage()
    {
        if (false === is_null($this->cachedPage)) {
            return $this->cachedPage;
        }

        $this->cachedPage = $this->website;

        return $this->cachedPage();
    }

    /**
     * @inheritDoc
     */
    public function contentTo(Response $response): Page
    {
        $response->send(
            $this->cachedPage()->contentTo($response)
        );

        return $this;
    }

}
