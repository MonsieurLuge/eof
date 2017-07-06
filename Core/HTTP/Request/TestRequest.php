<?php

namespace EOF\HTTP\Request;

use EOF\HTTP\Request\Request;

final class TestRequest implements Request
{

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function test(): Request
    {
        echo '<h1>' . $this->message . '</h1>';

        return $this;
    }

}
