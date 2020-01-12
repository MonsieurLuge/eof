<?php

namespace monsieurluge\eof\Service;

use monsieurluge\eof\Service\Service;

final class BaseService implements Service
{
    /** @var string */
    private $name;
    /** @var [type] */
    private $thing;

    public function __construct(string $name, $thing)
    {
        $this->name  = $name;
        $this->thing = $thing;
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return $this->name;
    }

    public function thing()
    {
        return $this->thing;
    }
}
