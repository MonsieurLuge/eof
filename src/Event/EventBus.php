<?php

namespace monsieurluge\pmf\Event;

use monsieurluge\pmf\Event\Event;
use monsieurluge\pmf\Event\EventListener;

interface EventBus
{
    public function register(EventListener $listener): void;

    public function send(Event $event): void;
}
