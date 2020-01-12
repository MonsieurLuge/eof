<?php

namespace monsieurluge\eof\Service;

use monsieurluge\eof\Service\Service;
use monsieurluge\eof\Service\ServiceRequest;
use monsieurluge\eof\Service\Services;
use monsieurluge\eof\Service\ServicesPool;

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
