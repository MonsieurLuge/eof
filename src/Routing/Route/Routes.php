<?php

namespace monsieurluge\pmf\Routing\Route;

use monsieurluge\pmf\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

interface Routes
{
    public function canHandle(Request $request): bool;

    public function handle(Request $request): void;
}
