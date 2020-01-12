<?php

namespace monsieurluge\pmf\Service;

use monsieurluge\pmf\Service\Service;
use monsieurluge\pmf\Service\ServiceRequest;

interface ServicesPool
{
    public function register(Service $service): void;

    public function send(ServiceRequest $request): void;
}
