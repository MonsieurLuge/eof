<?php

namespace monsieurluge\eof\Event;

use monsieurluge\eof\Event\Event;
use monsieurluge\eof\Event\EventListener;

final class TempEventBus
{
    /** @var array<EventListener> */
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
                $listener->listen($event);
            },
            $this->listeners
        );
    }
}
