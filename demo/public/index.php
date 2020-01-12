<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use DemoConfiguration\Service\DemoWebServices;
use monsieurluge\pmf\EntryPoint\WebApiEntryPoint;
use monsieurluge\pmf\Kernel\PmfKernel;
use monsieurluge\pmf\Service\BaseServicesPool;
use Symfony\Component\HttpFoundation\Request;

(new PmfKernel(
    new BaseServicesPool([]),
    new DemoWebServices(),
    new WebApiEntryPoint(
        'main router',
        Request::createFromGlobals()
    )
))->boot();
