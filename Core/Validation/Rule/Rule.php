<?php

namespace EOF\Validation\Rule;

use EOF\Validation\ValidationResult;

/**
 * Validation Rule interface
  * @codeCoverageIgnore
 */
interface Rule
{

    /**
     * Applies the rule to the given target.
     * If the rule breaks, an error is added to the result set.
     * @param  mixed                     $target
     * @param  string                    $name
     * @param  ValidationResult $result
     * @return Rule
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule;

}
