<?php

namespace EOF\Validation\Picker;

use EOF\Validation\Picker\Picker;

/**
 * Fake Picker (immutable object).
 * For test purpose only. Always returns the value given to the constructor.
 */
final class FakePicker implements Picker
{

    /** @var mixed **/
    private $returnValue;

    /**
     * @codeCoverageIgnore
     * @param mixed $returnValue
     */
    public function __construct($returnValue)
    {
        $this->returnValue = $returnValue;
    }

    /**
     * @inheritDoc
     */
    public function valueFrom($target)
    {
        return $this->returnValue;
    }

}
