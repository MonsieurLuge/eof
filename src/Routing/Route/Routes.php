<?php

namespace monsieurluge\eof\Routing\Route;

use monsieurluge\eof\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

interface Routes
{
    public function canHandle(Request $request): bool;

    public function handle(Request $request): void;
}
