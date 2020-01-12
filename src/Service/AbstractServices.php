<?php

namespace monsieurluge\pmf\Service;

use monsieurluge\pmf\Service\Service;
use monsieurluge\pmf\Service\ServiceRequest;
use monsieurluge\pmf\Service\Services;
use monsieurluge\pmf\Service\ServicesPool;

abstract class AbstractServices implements Services
{
    /**
     * @inheritDoc
     */
    public function register(ServicesPool $pool): void
    {
        array_map(
            function (Service $service) use ($pool) {
                $pool->register($service);
            },
            $this->services()
        );
    }

    abstract protected function services(): array;
}
