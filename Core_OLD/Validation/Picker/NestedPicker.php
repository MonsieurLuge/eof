<?php

namespace EOF\Validation\Picker;

use \Exception;
use EOF\Validation\Picker\Picker;

/**
 * Nested Picker (immutable object).
 * Returns the final picked value, using a set of pickers on a target object.
 */
final class NestedPicker implements Picker
{

    /** @var Picker[] **/
    private $pickers;

    /**
     * @codeCoverageIgnore
     * @param Picker[] $pickers
     */
    public function __construct(array $pickers = [])
    {
        $this->pickers = $pickers;
    }

    /**
     * @inheritDoc
     */
    public function valueFrom($target)
    {
        try {
            $value = array_reduce($this->pickers, [ $this, 'usePickerOn' ], $target);
        } catch (Exception $exception) {
            $message = sprintf('failed to pick a value from a picker set: %s', $exception->getMessage());

            throw new Exception($message, 0, $exception);
        }

        return $value;
    }

    /**
     * Calls the picker on the given target and returns the value.
     * @codeCoverageIgnore
     * @param  mixed           $target
     * @param  Picker $picker
     * @return mixed
     */
    private function usePickerOn($target, Picker $picker) {
        return $picker->valueFrom($target);
    }

}
