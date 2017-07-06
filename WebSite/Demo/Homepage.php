<?php

namespace Website\Demo;

use EOF\Page\Page;
use EOF\Website\Website;

/**
 * Demo Homepage
 */
final class Homepage implements Page
{

    /**
     * @inheritDoc
     */
    public function contentFor(Website $website): Page
    {
        $website->content('<h1>Demo homepage</h1>');

        return $this;
    }

}
