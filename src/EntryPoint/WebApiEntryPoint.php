<?php

namespace monsieurluge\eof\EntryPoint;

use monsieurluge\eof\EntryPoint\EntryPoint;
use monsieurluge\eof\Service\ServiceRequest;
use monsieurluge\eof\Service\RouterServiceRequest;
use monsieurluge\eof\Service\ServicesPool;
use monsieurluge\eof\Routing\Router\Router;
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
