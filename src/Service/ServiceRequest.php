<?php

namespace monsieurluge\eof\Service;

use Closure;

interface ServiceRequest
{
    public function resolve($service): void;

    public function signature(): string;
}
