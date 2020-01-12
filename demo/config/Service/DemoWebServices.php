<?php

namespace DemoConfiguration\Service;

use Closure;
use DemoConfiguration\Routing\ApiGetRoutes;
use monsieurluge\eof\Routing\Route\NotFound;
use monsieurluge\eof\Routing\Router\RouterWithFallback;
use monsieurluge\eof\Service\BaseService;
use monsieurluge\eof\Service\AbstractServices;

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
