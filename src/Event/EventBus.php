<?php

namespace monsieurluge\eof\Event;

use monsieurluge\eof\Event\Event;
use monsieurluge\eof\Event\EventListener;

interface EventBus
{
    public function register(EventListener $listener): void;

    public function send(Event $event): void;
}
