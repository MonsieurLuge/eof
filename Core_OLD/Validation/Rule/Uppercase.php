<?php

namespace EOF\Validation\Rule;

use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * Uppercase rule (immutable object).
 * Checks if the target characters are in uppercase; if so, an error is added to the result set.
 */
final class Uppercase implements Rule
{

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        if (strtoupper($target) !== $target) {
            $result->addError(sprintf('"%s" doit être en majuscules', $name));
        }

        return $this;
    }

}
