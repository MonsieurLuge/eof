<?php

namespace EOF\Router;

use Symfony\Component\HttpFoundation\Request;

interface Router
{

    public function dispatch(Request $request): Router;

}
