<?php

namespace monsieurluge\pmf\Service;

use monsieurluge\pmf\Service\Service;
use monsieurluge\pmf\Service\ServicesPool;
use monsieurluge\pmf\Service\ServiceRequest;

final class BaseServicesPool implements ServicesPool
{
    /** @var array */
    private $services;

    public function __construct()
    {
        $this->services = [];
    }

    /**
     * @inheritDoc
     */
    public function register(Service $service): void
    {
        $this->services[$service->name()] = $service;
    }

    /**
     * @inheritDoc
     */
    public function send(ServiceRequest $request): void
    {
        array_map(
            function (Service $service) use ($request) {
                $request->resolve($service->thing());
            },
            array_filter(
                $this->services,
                function (Service $item) use ($request) {
                    return $request->signature() === $item->name();
                }
            )
        );
    }
}
