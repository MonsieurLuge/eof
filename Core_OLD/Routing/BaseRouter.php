<?php

namespace EOF\Routing;

use EOF\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

final class BaseRouter implements Router
{
    /** @var Route[] **/
    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    /**
    * @inheritDoc
    */
    public function add(Route $route): Router
    {
        $this->routes[] = $route;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(Request $request): Router
    {
        array_map(
            function (Route $route) use ($request) { $route->handle($request); },
            array_filter(
                $this->routes,
                function (Route $route) use ($request) { return $route->canHandle($request); }
            )
        );

        return $this;
    }
}
