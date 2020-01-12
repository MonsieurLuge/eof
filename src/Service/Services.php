<?php

namespace monsieurluge\pmf\Service;

use monsieurluge\pmf\Service\ServicesPool;

interface Services
{
    public function register(ServicesPool $pool): void;
}
