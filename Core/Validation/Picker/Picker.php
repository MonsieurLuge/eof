<?php

namespace EOF\Validation\Picker;

/**
 * Value Picker interface
 */
interface Picker
{

    /**
     * Picks and returns the desired value from the given target.
     * @param mixed $target
     * @return mixed
     */
    public function valueFrom($target);

}
