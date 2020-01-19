<?php

namespace monsieurluge\eof\Service;

use Closure;
use monsieurluge\eof\Service\Service;

interface ServiceRequest
{
    public function resolve(Service $service): void;

    public function signature(): string;
}
