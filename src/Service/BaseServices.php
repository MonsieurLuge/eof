<?php

namespace monsieurluge\eof\Service;

use Closure;
use Exception;
use monsieurluge\eof\Service\Service;
use monsieurluge\eof\Service\Services;

final class BaseServices implements Services
{
    /** @var array<Service> */
    private $services;

    /**
     * @param array<Service> $services
     */
    public function __construct(array $services)
    {
        $this->services = $services;
    }

    /**
     * @inheritDoc
     */
    public function register(ServicesPool $pool): void
    {
        // todo
    }

    /**
     * @inheritDoc
     */
    public function service(string $name): Service
    {
        if (false === isset($this->services[$name])) {
            throw new Exception(sprintf(
                'the service "%s" cannot be provided, it must be defined first',
                $name
            ));
        }

        return ($this->services[$name])($this);
    }
}
