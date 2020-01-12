<?php

namespace monsieurluge\eof\Service;

use monsieurluge\eof\Service\Service;
use monsieurluge\eof\Service\ServicesPool;
use monsieurluge\eof\Service\ServiceRequest;

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
