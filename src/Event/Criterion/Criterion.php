<?php

namespace monsieurluge\pmf\Event\Criterion;

use Closure;
use monsieurluge\pmf\Event\Event;

interface Criterion
{
    public function validated(Event $event, Closure $next): void;
}
