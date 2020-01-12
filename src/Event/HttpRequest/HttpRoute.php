<?php

namespace monsieurluge\pmf\Event\HttpRequest;

use monsieurluge\pmf\Event\Event;
use monsieurluge\pmf\Event\EventListener;
use monsieurluge\pmf\Routing\RouteTarget;

final class HttpRoute implements EventListener
{
    private $criteria;
    private $target;

    public function __construct($criteria, RouteTarget $target)
    {
        $this->criteria = $criteria;
        $this->target   = $target;
    }

    /**
     * @inheritDoc
     */
    public function listen(Event $event): void
    {
        if ('HTTP request' !== $event->signature()) {
            return;
        }

        $this->criteria->validated(
            $event,
            function () {
                $this->target->handle();
            }
        );
    }
}
