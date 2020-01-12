<?php

namespace monsieurluge\pmf\Event;

use monsieurluge\pmf\Event\Event;
use monsieurluge\pmf\Event\EventListener;

final class TempEventBus
{
    /** @var array */
    private $listeners;

    public function __construct()
    {
        $this->listeners = [];
    }

    public function register(EventListener $listener): void
    {
        $this->listeners[] = $listener;
    }

    public function send(Event $event): void
    {
        array_map(
            function (EventListener $listener) use ($event) {
                $listener->listen($event)
            },
            $this->listeners
        );
    }
}
