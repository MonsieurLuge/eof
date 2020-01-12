<?php

namespace EOF\Validation\Rule;

use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * Not Empty rule (immutable object).
 * Checks if the target is empty; if so, an error is added to the result set.
 */
final class NotEmpty implements Rule
{

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        if (true === empty($target)) {
            $result->addError(sprintf('"%s" ne doit pas être vide', $name));
        }

        return $this;
    }

}
