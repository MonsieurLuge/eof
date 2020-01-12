<?php

namespace EOF\Validation\Rule;

use \InvalidArgumentException;
use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * "Between" rule (immutable object).
 * Checks if the target is between the boundaries; if not, an error is added to the result set.
 * The target value should be an integer.
 */
final class Between implements Rule
{

    /** @var int **/
    private $lowerBoundary;
    /** @var int **/
    private $upperBoundary;

    /**
     * @param int $lowerBoundary
     * @param int $upperBoundary
     * @throws InvalidArgumentException if the upper boundary is less or equal to the lower one
     */
    public function __construct(int $lowerBoundary, int $upperBoundary)
    {
        if ($lowerBoundary >= $upperBoundary) {
            throw new InvalidArgumentException('the "upper" boundary must be strictly greater than the "lower" one');
        }

        $this->lowerBoundary = $lowerBoundary;
        $this->upperBoundary = $upperBoundary;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        if ($this->lowerBoundary > $target || $this->upperBoundary < $target) {
            $result->addError(sprintf(
                '"%s" doit être compris dans l\'intervalle [%s-%s] (reçu : %s)',
                $name,
                $this->lowerBoundary,
                $this->upperBoundary,
                $target
            ));
        }

        return $this;
    }

}
