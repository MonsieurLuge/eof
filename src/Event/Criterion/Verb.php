<?php

namespace monsieurluge\eof\Event\Criterion;

use Closure;
use monsieurluge\eof\Event\Criterion\Criterion;
use monsieurluge\eof\Event\HttpRequestEvent;

final class Verb implements Criterion
{
    private $expected;

    public function __construct(string $expected)
    {
        $this->expected = $expected;
    }

    /**
     * @inheritDoc
     */
    public function validated($event, Closure $next): void
    {
        if ($this->expected === $event->request->getMethod()) {
            ($next)($event);
        };
    }
}
