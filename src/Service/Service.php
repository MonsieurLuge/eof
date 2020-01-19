<?php

namespace monsieurluge\eof\Service;

interface Service
{
    public function name(): string;

    /**
     * Temporary method, returns a "thing".
     *
     * @return mixed
     */
    public function thing();
}
