<?php

namespace monsieurluge\pmf\Kernel;

use monsieurluge\pmf\EntryPoint\EntryPoint;
use monsieurluge\pmf\Kernel\Kernel;
use monsieurluge\pmf\Service\Services;
use monsieurluge\pmf\Service\ServicesPool;

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
