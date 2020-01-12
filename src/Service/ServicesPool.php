<?php

namespace monsieurluge\eof\Service;

use monsieurluge\eof\Service\Service;
use monsieurluge\eof\Service\ServiceRequest;

interface ServicesPool
{
    public function register(Service $service): void;

    public function send(ServiceRequest $request): void;
}
