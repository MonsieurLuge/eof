<?php

namespace EOF\Validation\Rule;

use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * In Array rule (immutable object).
 * Checks if the target value exists in the array; if not, an error is added to the result set.
 */
final class InArray implements Rule
{

    /** @var array **/
    private $values;

    /**
     * @codeCoverageIgnore
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        if (false === in_array($target, $this->values, true)) {
            $result->addError(sprintf(
                '"%s" doit correspondre à l\'une de ces valeurs : [%s]',
                $name,
                implode(', ', $this->values)
            ));
        }

        return $this;
    }

}
