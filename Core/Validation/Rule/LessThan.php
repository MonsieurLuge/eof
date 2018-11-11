<?php

namespace EOF\Validation\Rule;

use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * "Less Than" rule (immutable object).
 * Checks if the target is lower than the comparator one; if not, an error is added to the result set.
 * The target value should be an integer.
 */
final class LessThan implements Rule
{

    /** @var int **/
    private $comparator;

    /**
     * @codeCoverageIgnore
     * @param int $comparator the value to compare to
     */
    public function __construct(int $comparator)
    {
        $this->comparator = $comparator;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        if ($this->comparator <= intval($target)) {
            $result->addError(sprintf(
                '"%s" doit être strictement inférieur à %s (reçu : %s)',
                $name,
                $this->comparator,
                intval($target)
            ));
        }

        return $this;
    }

}
