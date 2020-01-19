<?php

namespace monsieurluge\eof\Service;

use Closure;
use monsieurluge\eof\Service\Service;
use monsieurluge\eof\Service\ServiceRequest;

final class RouterServiceRequest implements ServiceRequest
{
    /** @var Closure */
    private $callback;
    /** @var string */
    private $router;

    public function __construct(string $router, Closure $callback)
    {
        $this->callback = $callback;
        $this->router   = $router;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Service $service): void
    {
        ($this->callback)($service);
    }

    /**
     * @inheritDoc
     */
    public function signature(): string
    {
        return $this->router;
    }
}
