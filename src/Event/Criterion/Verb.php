<?php

namespace monsieurluge\eof\Event\Criterion;

use Closure;
use monsieurluge\eof\Event\Criterion\Criterion;
use monsieurluge\eof\Event\Event;
use monsieurluge\eof\Event\HttpRequestEvent;

final class Verb implements Criterion
{
    /** @var string */
    private $expected;

    public function __construct(string $expected)
    {
        $this->expected = $expected;
    }

    /**
     * @inheritDoc
     */
    public function validated(Event $event, Closure $next): void
    {
        if ($this->expected === $event->content()->getMethod()) {
            ($next)($event);
        };
    }
}
