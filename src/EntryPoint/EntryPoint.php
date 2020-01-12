<?php

namespace monsieurluge\pmf\EntryPoint;

use monsieurluge\pmf\Service\ServicesPool;

interface EntryPoint
{
    public function run(ServicesPool $services): void;
}
