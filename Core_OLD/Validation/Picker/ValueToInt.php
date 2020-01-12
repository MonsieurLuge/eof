<?php

namespace EOF\Validation\Picker;

use EOF\Validation\Picker\Picker;

/**
 * A Picker decorator.
 * Try to convert the decorated Picker returned value to int.
 */
final class ValueToInt implements Picker
{

    /** @var Picker **/
    private $origin;

    /**
     * @codeCoverageIgnore
     * @param Picker $origin
     */
    public function __construct(Picker $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @inheritDoc
     */
    public function valueFrom($target)
    {
        return intval($this->origin->valueFrom($target));
    }

}
