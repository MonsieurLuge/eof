<?php

namespace monsieurluge\eof\Routing;

use Symfony\Component\HttpFoundation\Request;

interface RouteTarget
{
    public function handle(Request $request): void;
}
