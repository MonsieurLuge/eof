<?php

namespace EOF\Validation\Rule;

use \InvalidArgumentException;
use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * "String Max Length" rule (immutable object).
 * Checks if the target string don't exceed a given length; if so, an error is added to the result set.
 */
final class MaxLength implements Rule
{

    /** @var int **/
    private $length;

    /**
     * @param int $length
     * @throws InvalidArgumentException if the length is not greater than 0
     */
    public function __construct(int $length)
    {
        if ($length <= 0) {
            throw new InvalidArgumentException(sprintf(
                'the MaxLength value must be greater than 0, received: %s',
                $length
            ));
        }

        $this->length = $length;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        if (strlen($target) > $this->length) {
            $result->addError(sprintf(
                '"%s" est trop long (%s caractères), maximum autorisé : %s',
                $name,
                strlen($target),
                $this->length
            ));
        }

        return $this;
    }

}
