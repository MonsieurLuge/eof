<?php

namespace monsieurluge\eof\Service;

use monsieurluge\eof\Service\ServicesPool;

interface Services
{
    public function register(ServicesPool $pool): void;
}
