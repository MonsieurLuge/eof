<?php

namespace monsieurluge\eof\Routing\Route;

use Closure;
use monsieurluge\eof\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

final class NotFound implements Route
{
    /**
     * @inheritDoc
     */
    public function canHandle(Request $request): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        header('HTTP/1.0 404 Not Found', true, 404);
    }
}
