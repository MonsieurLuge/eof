<?php

namespace DemoConfiguration\Routing;

use Demo\WebApi\Hello;
use monsieurluge\eof\Routing\Route\Route;
use monsieurluge\eof\Routing\Route\Routes;
use monsieurluge\eof\Routing\Route\AbstractRoutes;
use monsieurluge\eof\Routing\Route\SimpleRoute;
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
