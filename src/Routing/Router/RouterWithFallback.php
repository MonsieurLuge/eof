<?php

namespace monsieurluge\pmf\Routing\Router;

use Exception;
use monsieurluge\pmf\Routing\Route\Route;
use monsieurluge\pmf\Routing\Route\Routes;
use monsieurluge\pmf\Routing\Router\Router;
use Symfony\Component\HttpFoundation\Request;

final class RouterWithFallback implements Router
{
    /** @var Route */
    private $fallback;
    /** @var Routes */
    private $routes;

    public function __construct(Routes $routes, Route $fallback)
    {
        $this->fallback = $fallback;
        $this->routes   = $routes;
    }

    /**
     * @inheritDoc
     */
    public function register($route): void
    {
        // FIXME
    }

    /**
     * @inheritDoc
     */
    public function dispatch(Request $request): void
    {
        $this->routes->canHandle($request)
            ? $this->routes->handle($request)
            : $this->fallback->handle($request);
    }
}
