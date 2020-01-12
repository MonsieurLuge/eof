<?php

namespace monsieurluge\eof\Event;

use Symfony\Component\HttpFoundation\Request;

interface HttpRequestEvent
{
    public function request(): Request;
}
