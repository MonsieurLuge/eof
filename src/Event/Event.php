<?php

namespace monsieurluge\eof\Event;

interface Event
{
    /**
     * @return mixed
     */
    public function content();

    public function signature(): string;
}
