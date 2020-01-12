<?php

namespace EOF\Routing\Route;

use EOF\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

final class BaseRoute implements Route
{

    private $path;
    private $method;

    public function __construct(string $method, string $path)
    {
        $this->method = $method;
        $this->path   = $path;
    }

    public function canHandle(Request $request): bool
    {
        return $this->methodMatches($request) && $this->pathMatches($request);
    }

    public function handle(Request $request): Route
    {
        return $this;
    }

    private function methodMatches(Request $request): bool
    {
        return $this->method === $request->getMethod();
    }

    private function pathMatches(Request $request): bool
    {
        return $this->path === $request->getPathInfo();
    }

}
