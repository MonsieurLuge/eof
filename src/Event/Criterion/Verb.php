<?php

namespace monsieurluge\pmf\Event\Criterion;

use Closure;
use monsieurluge\pmf\Event\Criterion\Criterion;
use monsieurluge\pmf\Event\HttpRequestEvent;

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
    public function validated(HttpRequestEvent $event, Closure $next): void
    {
        if ($this->expected === $event->request->getMethod()) {
            ($next)($event);
        };
    }
}
