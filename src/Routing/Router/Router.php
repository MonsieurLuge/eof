<?php

namespace monsieurluge\pmf\Routing\Router;

use Symfony\Component\HttpFoundation\Request;

interface Router
{
    public function register($route): void;

    public function dispatch(Request $request): void;
}
