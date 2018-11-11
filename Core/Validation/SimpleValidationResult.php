<?php

namespace EOF\Validation;

use EOF\Validation\ValidationResult;

/**
 * Validation Result (mutable object).
 * Errors can be added to this result to change its validated state.
 */
final class SimpleValidationResult implements ValidationResult
{

    /** @var array **/
    private $errors;

    /**
     * @codeCoverageIgnore
     * @param array $errors errors as [[name => message], ...]
     */
    public function __construct(array $errors = [])
    {
        $this->errors = $errors;
    }

    /**
     * @inheritDoc
     */
    public function addError($message): ValidationResult
    {
        array_push($this->errors, $message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @inheritDoc
     */
    public function validated(): bool
    {
        return (0 === count($this->errors));
    }

}
