<?php

namespace EOF\Router;

use Symfony\Component\HttpFoundation\Request;

final class BaseRouter implements Router
{
    /**
     * @inheritDoc
     */
    public function dispatch(Request $request): Router
    {
        // todo
        return $this;
    }
}
