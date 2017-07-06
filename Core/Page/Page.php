<?php

namespace EOF\Page;

use EOF\Website\Website;

/**
 * Page Interface
 */
interface Page
{

    /**
     * TODO [contentFor description]
     * @param  Website $website
     * @return Page
     */
    public function contentFor(Website $website): Page;

}
