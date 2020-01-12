<?php

namespace monsieurluge\pmf\Service;

use Closure;

interface ServiceRequest
{
    public function resolve($service): void;

    public function signature(): string;
}
