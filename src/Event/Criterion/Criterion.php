<?php

namespace monsieurluge\eof\Event\Criterion;

use Closure;
use monsieurluge\eof\Event\Event;

interface Criterion
{
    public function validated(Event $event, Closure $next): void;
}
