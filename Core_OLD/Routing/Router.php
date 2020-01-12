<?php

namespace EOF\Routing;

use EOF\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

interface Router
{
    /**
     * Adds a route.
     *
     * @param Route  $route
     *
     * @return Router
     */
    public function add(Route $route): Router;

    /**
     * Dispatches the request to the routes.
     *
     * @param Request $request
     *
     * @return Router
     */
    public function dispatch(Request $request): Router;

}
