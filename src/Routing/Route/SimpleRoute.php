<?php

namespace monsieurluge\eof\Routing\Route;

use Closure;
use monsieurluge\eof\Routing\Route\Route;
use Symfony\Component\HttpFoundation\Request;

final class SimpleRoute implements Route
{
    private $target;

    public function __construct(Closure $target)
    {
        $this->target = $target;
    }

    /**
     * @inheritDoc
     */
    public function canHandle(Request $request): bool
    {
        return true; // FIXME
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        ($this->target)()->handle($request);
    }
}
