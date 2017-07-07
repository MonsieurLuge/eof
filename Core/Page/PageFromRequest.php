<?php

namespace EOF\Page;
use EOF\HTTP\Response\Response;
use EOF\Website\Website;

/**
 * A Page Factory
 */
final class PageFromRequest implements Page
{

    private $page;
    private $request;

    public function __construct($request)
    {
        $this->page    = null;
        $this->request = $request;
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

        $this->cachedPage = new toto();

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
