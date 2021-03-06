<?php

namespace EOF\Routing\Route;

use Symfony\Component\HttpFoundation\Request;

interface Route
{

    public function canHandle(Request $request): bool;

    public function handle(Request $request): Route;

}
