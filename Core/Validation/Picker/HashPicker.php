<?php

namespace EOF\Validation\Picker;

use \Exception;
use EOF\Validation\Picker\Picker;

/**
 * Hash value Picker (immutable object).
 * Allows to pick a value from a hash.
 */
final class HashPicker implements Picker
{

    /** @var string **/
    private $key;

    /**
     * @codeCoverageIgnore
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @inheritDoc
     */
    public function valueFrom($target)
    {
        if (false === array_key_exists($this->key, $target)) {
            throw new Exception(sprintf(
                'cannot pick the value of "%s": it doesn\'t exist in the target hash',
                $this->key
            ));
        }

        return $target[$this->key];
    }

}
