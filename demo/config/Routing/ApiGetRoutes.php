<?php

namespace DemoConfiguration\Routing;

use Demo\WebApi\Hello;
use monsieurluge\pmf\Routing\Route\Route;
use monsieurluge\pmf\Routing\Route\Routes;
use monsieurluge\pmf\Routing\Route\AbstractRoutes;
use monsieurluge\pmf\Routing\Route\SimpleRoute;
use Symfony\Component\HttpFoundation\Request;

final class ApiGetRoutes extends AbstractRoutes
{
    protected function routes(): array
    {
        return [
            new SimpleRoute(function () { return new Hello(); })
        ];
    }
}
