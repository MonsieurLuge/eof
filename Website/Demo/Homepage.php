<?php

namespace Website\Demo;

use EOF\Page\Page;

/**
 * Demo Homepage
 */
final class Homepage implements Page
{

    /**
     * @inheritDoc
     */
    public function content(): string
    {
        return '<h1>Demo homepage</h1>';
    }

}
