<?php

namespace Website\Demo\Pages;

use EOF\HTTP\Response\Response;
use EOF\Page\Page;
use EOF\Page\NotFound;
use Website\Demo\Homepage;

/**
 * A Page Factory for the Demo Website
 */
final class DemoPagesFactory implements Page
{

    /** @var Page **/
    private $cachedPage;
    private $request;

    public function __construct($request)
    {
        $this->cachedPage = null;
        $this->request    = $request;
    }

    /**
     * @inheritDoc
     */
    public function contentTo(Response $response): Page
    {
        $this->cachedPage()->contentTo($response);

        return $this;
    }

    /**
     * [cachedPage description]
     * @return Page [description]
     */
    private function cachedPage(): Page
    {
        if (false === is_null($this->cachedPage)) {
            return $this->cachedPage;
        }

        $this->cachedPage = $this->createPage();

        return $this->cachedPage();
    }

    /**
     * @inheritDoc
     */
    private function createPage(): Page
    {
        switch ($request->route()) {
            case '/':
                return new Homepage();
                break;
            default:
                return new NotFound();
                break;
        }
    }

}
