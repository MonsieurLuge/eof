<?php

namespace monsieurluge\eof\Event\HttpRequest;

use monsieurluge\eof\Event\Event;
use monsieurluge\eof\Event\EventListener;
use monsieurluge\eof\Routing\Route\RouteTarget;

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
