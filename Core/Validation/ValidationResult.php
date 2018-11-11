<?php

namespace EOF\Validation;

/**
 * Validation Result interface
  * @codeCoverageIgnore
 */
interface ValidationResult
{

    /**
     * Adds an error to the result set.
     * @param string $message
     * @return ValidationResult
     */
    public function addError($message): ValidationResult;

    /**
     * Returns the errors as [message, ...].
     * @return array
     */
    public function errors(): array;

    /**
     * Tells if the result is valid or not.
     * @return bool
     */
    public function validated(): bool;

}
