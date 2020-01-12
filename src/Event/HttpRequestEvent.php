<?php

namespace monsieurluge\pmf\Event;

use Symfony\Component\HttpFoundation\Request;

interface HttpRequestEvent
{
    public function request(): Request;
}
