<?php

namespace monsieurluge\eof\Kernel;

use monsieurluge\eof\EntryPoint\EntryPoint;
use monsieurluge\eof\Kernel\Kernel;
use monsieurluge\eof\Service\Services;
use monsieurluge\eof\Service\ServicesPool;

final class PmfKernel implements Kernel
{
    /** @var EntryPoint */
    private $entryPoint;
    /** @var ServicesPool */
    private $pool;
    /** @var Services */
    private $services;

    public function __construct(
        ServicesPool $pool,
        Services $services,
        EntryPoint $entryPoint
    ) {
        $this->entryPoint = $entryPoint;
        $this->pool       = $pool;
        $this->services   = $services;
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->services->register($this->pool);

        $this->entryPoint->run($this->pool);
    }
}
