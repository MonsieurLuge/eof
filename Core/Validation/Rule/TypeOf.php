<?php

namespace EOF\Validation\Rule;

use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * Type Of rule (immutable object).
 * Checks if the target's base type is the right one.
 */
final class TypeOf implements Rule
{

    /** @var string **/
    private $desiredType;

    /**
     * @codeCoverageIgnore
     * @param string $desiredType
     */
    public function __construct(string $desiredType)
    {
        $this->desiredType = $desiredType;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        if ($this->desiredType !== gettype($target)) {
            $result->addError(sprintf(
                '"%s" doit être de type "%s" (reçu : %s)',
                $name,
                $this->desiredType,
                gettype($target)
            ));
        }

        return $this;
    }

}
