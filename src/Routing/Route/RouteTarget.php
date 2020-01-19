<?php

namespace monsieurluge\eof\Routing\Route;

use Symfony\Component\HttpFoundation\Request;

interface RouteTarget
{
    public function handle(Request $request): void;
}
