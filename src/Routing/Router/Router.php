<?php

namespace monsieurluge\eof\Routing\Router;

use monsieurluge\eof\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

interface Router
{
    public function register(Route $route): void;

    public function dispatch(Request $request): void;
}
