<?php

namespace monsieurluge\eof\Routing\Route;

use monsieurluge\eof\Routing\Route\Route;
use monsieurluge\eof\Routing\Route\Routes;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRoutes implements Routes
{
    /**
     * @inheritDoc
     */
    public function canHandle(Request $request): bool
    {
        return 0 < count(
            array_filter(
                $this->routes(),
                function (Route $route) use ($request) {
                    return $route->canHandle($request);
                }
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        $availableRoutes = array_filter(
            $this->routes(),
            function (Route $route) use ($request) {
                return $route->canHandle($request);
            }
        );

        if (0 === count($availableRoutes)) {
            return;
        }

        ($availableRoutes[0])->handle($request);
    }

    /**
     * @return array<Route>
     */
    abstract protected function routes(): array;
}
