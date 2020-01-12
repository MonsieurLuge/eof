<?php

namespace DemoConfiguration\Service;

use Closure;
use DemoConfiguration\Routing\ApiGetRoutes;
use monsieurluge\pmf\Routing\Route\NotFound;
use monsieurluge\pmf\Routing\Router\RouterWithFallback;
use monsieurluge\pmf\Service\BaseService;
use monsieurluge\pmf\Service\AbstractServices;

final class DemoWebServices extends AbstractServices
{
    protected function services(): array
    {
        return [
            new BaseService(
                'main router',
                new RouterWithFallback(
                    new ApiGetRoutes(),
                    new NotFound()
                )
            )
        ];
    }
}
