<?php

namespace monsieurluge\eof\Service;

use monsieurluge\eof\Service\Service;
use monsieurluge\eof\Service\ServicesPool;

interface Services
{
    public function register(ServicesPool $pool): void;

    public function service(string $name): Service;
}
