<?php

namespace monsieurluge\eof\EntryPoint;

use monsieurluge\eof\Service\ServicesPool;

interface EntryPoint
{
    public function run(ServicesPool $services): void;
}
