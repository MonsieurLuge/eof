<?php

namespace monsieurluge\eof\Event;

use monsieurluge\eof\Event\Event;

interface EventListener
{
    public function listen(Event $event): void;
}
