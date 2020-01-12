<?php

namespace monsieurluge\pmf\Event\Criterion;

use Closure;
use monsieurluge\pmf\Event\Criterion\Criterion;
use monsieurluge\pmf\Event\Event;

final class Criteria implements Criterion
{
    /** @var array */
    private $criteria;

    public function __construct(array $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @inheritDoc
     */
    public function validated(Event $event, Closure $next): void
    {
        $this->resolve($this->criteria, $event);
    }

    private function resolve(array $criteria, Event $event, Closure $next)
    {
        if (0 === count($criteria)) {
            ($next)($event);
        }

        $criteria[0]->validated(
            $event,
            function () use ($criteria, $event) { $this->resolve($criteria, $event); }
        );
    }
}
