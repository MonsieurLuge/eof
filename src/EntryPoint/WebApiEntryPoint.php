<?php

namespace monsieurluge\pmf\EntryPoint;

use monsieurluge\pmf\EntryPoint\EntryPoint;
use monsieurluge\pmf\Service\ServiceRequest;
use monsieurluge\pmf\Service\RouterServiceRequest;
use monsieurluge\pmf\Service\ServicesPool;
use monsieurluge\pmf\Routing\Router\Router;
use Symfony\Component\HttpFoundation\Request;

final class WebApiEntryPoint implements EntryPoint
{
    /** @var ServiceRequest */
    private $serviceRequest;

    public function __construct(string $router, Request $request)
    {
        $this->serviceRequest = new RouterServiceRequest(
            $router,
            function (Router $service) use ($request) {
                $service->dispatch($request);
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function run(ServicesPool $services): void
    {
        $services->send($this->serviceRequest);
    }
}
