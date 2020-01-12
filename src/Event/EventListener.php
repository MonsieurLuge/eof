<?php

namespace monsieurluge\pmf\Event;

use monsieurluge\pmf\Event\Event;

interface EventListener
{
    public function listen(Event $event): void;
}
