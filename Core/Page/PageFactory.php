<?php

namespace EOF\Page;

use EOF\Page\Page;

/**
 * Page Factory Interface
 */
interface PageFactory
{

    /**
     * Creates a Page.
     * @return Page
     */
    public function createPage() : Page;

}
