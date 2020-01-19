<?php

namespace monsieurluge\eof\Event\Criterion;

use Closure;
use monsieurluge\eof\Event\Criterion\Criterion;
use monsieurluge\eof\Event\Event;

final class Criteria implements Criterion
{
    /** @var array<Criterion> */
    private $criteria;

    /**
     * @param array<Criterion> $criteria
     */
    public function __construct(array $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @inheritDoc
     */
    public function validated(Event $event, Closure $next): void
    {
        $this->resolve($this->criteria, $event, $next);
    }

    /**
     * @param array<Criterion> $criteria
     * @param Event            $event
     * @param Closure          $next
     */
    private function resolve(array $criteria, Event $event, Closure $next): void
    {
        if (0 === count($criteria)) {
            ($next)($event);
        }

        $criteria[0]->validated(
            $event,
            function () use ($criteria, $event, $next) { $this->resolve($criteria, $event, $next); }
        );
    }
}
