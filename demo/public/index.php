<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use DemoConfiguration\Service\DemoWebServices;
use monsieurluge\eof\EntryPoint\WebApiEntryPoint;
use monsieurluge\eof\Kernel\PmfKernel;
use monsieurluge\eof\Service\BaseServicesPool;
use Symfony\Component\HttpFoundation\Request;

(new PmfKernel(
    new BaseServicesPool([]),
    new DemoWebServices(),
    new WebApiEntryPoint(
        'main router',
        Request::createFromGlobals()
    )
))->boot();
